<?php

namespace App\Http\Controllers;

use File;

use App\Models\Topics;
use App\Models\Courses;
use App\Models\Subjects;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class AdminSubjectsController extends Controller
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
    $course_id = $request->input('course_id') ?? '';
    $course_name = $request->input('course_name') ?? '';
    $search = $request->input('search') ?? '';
    $limit = $request->input('limit') ?? '10';

    $subjects = Subjects::orderBy('id', 'desc');
    if(isset($course_id) && $course_id > 0) {
      $subjects = $subjects->where('course_id', $course_id);
    }
    if(isset($search) && $search != '') {
      $subjects = $subjects->where('name', 'like', "%{$search}%");
    }
    $subjects = $subjects->paginate($limit);
    $courses = Courses::pluck('name', 'id');

    $data = [
      'authuser' => Auth::user(),
      'Header' => 'Subjects',
      'courses' => $courses,
      'subjects' => $subjects,
      'search' => $search,
      'limit' => $limit,
      'course_id' => $course_id,
      'course_name' => $course_name
    ];

    return view('admin.subjects.index')->with($data);
  }


  public function store(Request $request)
  {
    $image = '';
    $slugname = strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $request->input('name'))).'-'.Auth::id();

    if($request->hasFile('image')) {
      $getimage = $request->file('image');
      $extension = $request->file('image')->getClientOriginalExtension();
      $path = public_path(). '/uploads/subjects/';
      File::makeDirectory($path, $mode = 0777, true, true);
      $getimage->move($path, $slugname.'.'.$extension);
      $image = '/uploads/subjects/' .$slugname.'.' .$extension;
    }

    $subject = new Subjects();
    $subject->course_id = $request->input('course_id') ?? '0';
    $subject->name = $request->input('name') ?? '';
    $subject->desc = $request->input('desc') ?? '';
    $subject->image = $image ?? '';
    $subject->save();

    return redirect('/admin/subjects')->with('success', 'Subject Added');
  }


  public function update(Request $request)
  {
    $id = $request->input('id') ?? '0';
    $image = '';
    $slugname = strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $request->input('name'))).'-'.Auth::id();

    if($request->hasFile('image')) {
      $getimage = $request->file('image');
      $extension = $request->file('image')->getClientOriginalExtension();
      $path = public_path(). '/uploads/subjects/';
      File::makeDirectory($path, $mode = 0777, true, true);
      $getimage->move($path, $slugname.'.'.$extension);
      $image = '/uploads/subjects/' .$slugname.'.' .$extension;
    }

    $subject = Subjects::find($id);
    $subject->course_id = $request->input('course_id') ?? '0';
    $subject->name = $request->input('name') ?? '';
    $subject->desc = $request->input('desc') ?? '';
    $subject->image = ($image ? $image : $request->input('imageOld')) ?? '';
    $subject->save();

    return redirect('/admin/subjects')->with('success', 'Subject Updated');
  }

  public static function countTopics($id)
  {
    return Topics::where('subject_id', $id)->count();
  }

  public function destroy($id)
  {
    $course = Subjects::find($id);
    $course->delete();

    return redirect('/admin/subjects')->with('success', 'Subject Deleted');
  }

  public static function getSubjectCourse($id)
  {
    $course_id =  Subjects::where('id', $id)->value('course_id');
    return Courses::where('id', $course_id)->value('name');
  }

  public static function getSubjectCourseID($id)
  {
    return Subjects::where('id', $id)->value('course_id');
  }
}
