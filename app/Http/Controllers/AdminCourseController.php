<?php

namespace App\Http\Controllers;

use File;

use App\Models\Courses;
use App\Models\Category;
use App\Models\Subjects;
use App\Models\Highlights;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class AdminCourseController extends Controller
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
    $cat_id = $request->input('cat_id') ?? '';
    $cat_name = $request->input('cat_name') ?? '';
    $status = $request->input('status') ?? '';
    $search = $request->input('search') ?? '';
    $limit = $request->input('limit') ?? '10';

    $courses = Courses::orderBy('id', 'desc');
    if(isset($status) && $status != '' && $status != 'All') {
      $courses = $courses->where('status', $status);
    }
    if(isset($cat_id) && $cat_id > 0) {
      $courses = $courses->where('cat_id', $cat_id);
    }
    if(isset($search) && $search != '') {
      $courses = $courses->where('name', 'like', "%{$search}%");
    }
    $courses = $courses->paginate($limit);
    $category = Category::pluck('name', 'id');

    $data = [
      'authuser' => Auth::user(),
      'Header' => 'Courses',
      'courses' => $courses,
      'status' => $status,
      'search' => $search,
      'limit' => $limit,
      'cat_id' => $cat_id,
      'cat_name' => $cat_name,
      'category' => $category
    ];

    return view('admin.courses.index')->with($data);
  }

  public function create()
  {
    $data = [
      'authuser' => Auth::user(),
      'Header' => 'Courses',
      'SubHeader' => 'Add Course',
    ];

    return view('admin.courses.create')->with($data);
  }

  public function store(Request $request)
  {
    $image = '';
    $slugname = strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $request->input('name'))).'-'.Auth::id();

    if($request->hasFile('image')) {
      $getimage = $request->file('image');
      $extension = $request->file('image')->getClientOriginalExtension();
      $path = public_path(). '/uploads/courses/';
      File::makeDirectory($path, $mode = 0777, true, true);
      $getimage->move($path, $slugname.'.'.$extension);
      $image = '/uploads/courses/' .$slugname.'.' .$extension;
    }

    $course = new Courses();
    $course->cat_id = $request->input('cat_id') ?? '0';
    $course->name = $request->input('name') ?? '';
    $course->duration = $request->input('duration') ?? '1';
    $course->amount = $request->input('amount') ?? '0';
    $course->offer_amount = $request->input('offer_amount') ?? '0';
    $course->keyword = $request->input('keyword') ?? '';
    $course->content = $request->input('content') ?? '';
    $course->overview = $request->input('overview') ?? '';
    $course->desc = $request->input('desc') ?? '';
    $course->highlight = $request->input('highlight') ?? '';
    $course->notes = $request->input('notes') ?? '';
    $course->status = $request->input('status') ?? '';
    $course->image = $image ?? '';
    $course->save();

    return redirect('/admin/courses')->with('success', 'Course Added');
  }

  public function show($id)
  {
    $course = Courses::find($id);
    $catname = Category::where('id', $course->cat_id)->value('name');

    $data = [
      'authuser' => Auth::user(),
      'Header' => 'Courses',
      'SubHeader' => 'Edit Courses',
      'course' => $course,
      'catname' => $catname ?? ''
    ];

    return view('admin.courses.edit')->with($data);
  }

  public function update(Request $request, $id)
  {
    $image = '';
    $slugname = strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $request->input('name'))).'-'.Auth::id();

    if($request->hasFile('image')) {
      $getimage = $request->file('image');
      $extension = $request->file('image')->getClientOriginalExtension();
      $path = public_path(). '/uploads/courses/';
      File::makeDirectory($path, $mode = 0777, true, true);
      $getimage->move($path, $slugname.'.'.$extension);
      $image = '/uploads/courses/' .$slugname.'.' .$extension;
    }

    $course = Courses::find($id);
    $course->cat_id = $request->input('cat_id') ?? '0';
    $course->name = $request->input('name') ?? '';
    $course->duration = $request->input('duration') ?? '1';
    $course->amount = $request->input('amount') ?? '0';
    $course->offer_amount = $request->input('offer_amount') ?? '0';
    $course->keyword = $request->input('keyword') ?? '';
    $course->content = $request->input('content') ?? '';
    $course->overview = $request->input('overview') ?? '';
    $course->desc = $request->input('desc') ?? '';
    $course->highlight = $request->input('highlight') ?? '';
    $course->notes = $request->input('notes') ?? '';
    $course->status = $request->input('status') ?? '';
    $course->image = ($image ? $image : $request->input('imageOld')) ?? '';
    $course->save();

    return redirect('/admin/courses')->with('success', 'Course Updated');
  }

  public function destroy($id)
  {
    $course = Courses::find($id);
    $course->delete();

    return redirect('/admin/courses')->with('success', 'Course Deleted');
  }

  public static function countSubjects($id)
  {
    return Subjects::where('course_id', $id)->count();
  }

  public static function getCourseCategory($id)
  {
    $cat_id =  Courses::where('id', $id)->value('cat_id');
    return Category::where('id', $cat_id)->value('name');
  }


  public function highlights($id, Request $request)
  {
    $course = Courses::find($id);
    $highlights = Highlights::orderBy('disp_order', 'asc')->where('course_id', $id)->get();
    $disp_order = Highlights::where('course_id', $id)->max('disp_order') ?? '0';
    $courses = Courses::pluck('name', 'id');

    $data = [
      'authuser' => Auth::user(),
      'highlights'  => $highlights,
      'Header' => 'Courses',
      'disp_order' => ($disp_order > 0) ? $disp_order + 1 : '1',
      'course' => $course,
      'id' => $id,
      'courses' => $courses
    ];

    return view('admin.courses.highlights')->with($data);
  }

  public function createHighlights($id, Request $request)
  {
    $highlights = new Highlights();
    $highlights->course_id = $request->input('course_id') ?? '0';
    $highlights->disp_order = $request->input('disp_order') ?? '1';
    $highlights->heading = $request->input('heading') ?? '';
    $highlights->desc = $request->input('desc') ?? '';
    $highlights->save();

    return redirect('/admin/courses/'.$id.'/highlights')->with('success', 'New Highlight Created');
  }

  public function updateHighlights($id, $hid, Request $request)
  {
    $highlights = Highlights::find($hid);
    $highlights->course_id = $request->input('course_id') ?? '0';
    $highlights->disp_order = $request->input('disp_order') ?? '1';
    $highlights->heading = $request->input('heading') ?? '';
    $highlights->desc = $request->input('desc') ?? '';
    $highlights->save();

    return redirect('/admin/courses/'.$id.'/highlights')->with('success', 'Highlight Updated');
  }

  public function destroyHighlights($id, $hid, Request $request)
  {
    $highlights = Highlights::find($hid);
    $highlights->delete();

    return redirect('/admin/courses/'.$id.'/highlights')->with('success', 'Highlight Deleted');
  }
}
