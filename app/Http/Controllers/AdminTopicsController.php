<?php

namespace App\Http\Controllers;

use File;

use App\Models\Subjects;
use App\Models\Topics;
use App\Models\TopicsContent;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;

use Vimeo\Vimeo;

class AdminTopicsController extends Controller
{

  public function __construct(Request $request, Redirector $redirect)
  {
    $this->middleware(function ($request, $next) {
      if (!Auth::id() || (isset(Auth::user()->type) && Auth::user()->type != 'Admin')) {
        return redirect('/admin/login');
      }
      return $next($request);
    });
  }

  public function index(Request $request)
  {
    $subject_id = $request->input('subject_id') ?? '';
    $subject_name = $request->input('subject_name') ?? '';
    $search = $request->input('search') ?? '';
    $limit = $request->input('limit') ?? '10';

    $topics = Topics::orderBy('id', 'desc');
    if(isset($subject_id) && $subject_id > 0) {
      $topics = $topics->where('subject_id', $subject_id);
    }
    if(isset($search) && $search != '') {
      $topics = $topics->where('name', 'like', "%{$search}%");
    }
    $topics = $topics->paginate($limit);
    $subjects = Subjects::pluck('name', 'id');

    $data = [
      'authuser' => Auth::user(),
      'Header' => 'Topics',
      'topics' => $topics,
      'subjects' => $subjects,
      'search' => $search,
      'limit' => $limit,
      'subject_id' => $subject_id,
      'subject_name' => $subject_name
    ];

    return view('admin.topics.index')->with($data);
  }

  public function store(Request $request)
  {
    $topic = new Topics();
    $topic->subject_id = $request->input('subject_id') ?? '0';
    $topic->name = $request->input('name') ?? '';
    $topic->save();

    return redirect('/admin/topics')->with('success', 'Topic Added');
  }

  public function update(Request $request)
  {
    $id = $request->input('id') ?? '';
    
    $topic = Topics::find($id);
    $topic->subject_id = $request->input('subject_id') ?? '0';
    $topic->name = $request->input('name') ?? '';
    $topic->save();

    return redirect('/admin/topics')->with('success', 'Topic Updated');
  }

  public function destroy($id)
  {
    $course = Topics::find($id);
    $course->delete();

    return redirect('/admin/topics')->with('success', 'Topic Deleted');
  }

  public function contents(Request $request, $id)
  {
    $no = 0;
    $page = $request->input('page') ?? 1;
    $page = $page - 1;
    if(isset($page)) { $no = $page * 10; }
    $types = $request->input('types') ?? '';
    $search = $request->input('search') ?? '';
    $limit = $request->input('limit') ?? '10';

    $topicContents = TopicsContent::orderBy('id', 'desc');
    $topicContents = $topicContents->where('topic_id', $id);
    if(isset($types) && $types != '') {
      $topicContents = $topicContents->where('type', $types);
    }
    if(isset($search) && $search != '') {
      $topicContents = $topicContents->where('url', 'like', "%{$search}%");
    }
    $topicContents = $topicContents->paginate($limit);
    $topicname = Topics::where('id', $id)->value('name');

    $data = [
      'authuser' => Auth::user(),
      'Header' => 'Topics',
      'SubHeader' => 'Topics Contents',
      'topicContents' => $topicContents,
      'topicname' => $topicname,
      'search' => $search,
      'limit' => $limit,
      'types' => $types,
      'no' => $no,
      'id' => $id
    ];

    return view('admin.topics.contents')->with($data);
  }

  public function createContents(Request $request, $id)
  {

    $data = [
      'authuser' => Auth::user(),
      'Header' => 'Topics',
      'SubHeader' => 'Topics Contents',
      'id' => $id
    ];

    return view('admin.topics.createcontents')->with($data);
  }

  public function storeContents(Request $request)
  {
    $url = '';
    if($request->input('type') == 'Video') {
      $client = new Vimeo("d3c7e6807978ff1279f3edda61956b32f2add644", "a1ZtKPslHftRWo7/kxBlnwO6vTdFLul2JfHzqeSVEQZzv+UIe2GR7RXu7YafcDd8jugwUlq2YAlLZ+2p5T84QXbl+jvSTusOuucADE09xo8gwsA7uqOVz6k/C+kiZpYL", "7f9064ba3fc19b14fb5f07dd821ec405");
      if($_FILES['file']['name']) {
        $file_name = $_FILES['file']['tmp_name'];
        $uri = $client->upload($file_name, array(
          "name" => "Test 1234",
          'privacy' => array(
            'view' => 'disable'
          ),
          "description" => "The description goes here."
        ));

        echo "Your video URI is: " . $uri;
        $url = $uri;
      } else {
        echo 'Invalid file. please try again';
      }
    }

    $slugname = strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $request->input('name'))).'-'.date('sdinHY');
    if($request->input('type') == 'Notes') {
      if($request->hasFile('file')) {
        $getimage = $request->file('file');
        $extension = $request->file('file')->getClientOriginalExtension();
        $path = public_path(). '/uploads/topic/';
        File::makeDirectory($path, $mode = 0777, true, true);
        $getimage->move($path, $slugname.'.'.$extension);
        $url = '/uploads/topic/' .$slugname.'.' .$extension;
      }
    }

    $topic = new TopicsContent();
    $topic->topic_id = $request->input('tid') ?? '0';
    $topic->name = $request->input('name') ?? '';
    $topic->type = $request->input('type') ?? '';
    $topic->url = $url ?? '';
    $topic->save();

    return redirect('/admin/topics/contents/'.$request->input('tid'))->with('success', 'Topic Content Added');
  }

  public function updateContents(Request $request)
  {
    // $id = $request->input('id') ?? '';
    // $topic = TopicsContent::find($id);
    // $topic->topic_id = $request->input('tid') ?? '0';
    // $topic->name = $request->input('name') ?? '';
    // $topic->type = $request->input('type') ?? '';
    // $topic->url = $request->input('url') ?? '';
    // $topic->save();

    return redirect('/admin/topics/contents/'.$request->input('tid'))->with('success', 'Topic Content Updated');
  }

  public function deleteContents($id, $did)
  {
    TopicsContent::where('id', $did)->delete();

    return redirect('/admin/topics/contents/'.$id)->with('success', 'Topic Content Removed');
  }

  public static function countContent($id)
  {
    return TopicsContent::where('topic_id', $id)->count();
  }
}
