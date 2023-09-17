<?php

namespace App\Http\Controllers;

use File;

use App\Models\Courses;
use App\Models\Category;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class AdminCategoryController extends Controller
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
    $no = 0;
    $page = $request->input('page') ?? 1;
    $page = $page - 1;
    if(isset($page)) { $no = $page * 10; }
    $search = $request->input('search') ?? '';

    $category = Category::orderBy('disp_order', 'asc');
    if(isset($search) && $search != '') {
      $category = $category->where('name', 'like', "%{$search}%");
    }
    $category = $category->paginate(10);
    $disporder = Category::max('disp_order');

    $data = [
      'authuser' => Auth::user(),
      'categories'  => $category,
      'Header' => 'Category',
      'search' => $search,
      'disporder' => ($disporder > 0) ? $disporder + 1 : '1',
      'no' => $no
    ];

    return view('admin.category.index')->with($data);
  }

  public function create(Request $request)
  {
    $image = '';
    $name = preg_replace("/[^a-zA-Z0-9]+/", "", $request->input('name')).'-'.Auth::id();
    
    if($request->hasFile('image')) {
      $getimage = $request->file('image');
      $extension = $request->file('image')->getClientOriginalExtension();
      $path = public_path(). '/uploads/category/';
      File::makeDirectory($path, $mode = 0777, true, true);
      $getimage->move($path, $name.'.'.$extension);
      $image = '/uploads/category/' .$name. '.' .$extension;
    }

    $category = new Category();
    $category->name = $request->input('name');
    $category->disp_order = $request->input('disporder') ?? '1';
    $category->image = $image ?? '';
    $category->save();

    return redirect('/admin/category')->with('success', 'New Category Created');
  }

  public function update(Request $request)
  {
    $image = '';
    $name = preg_replace("/[^a-zA-Z0-9]+/", "", $request->input('name')).'-'.Auth::id();
    
    if($request->hasFile('image')) {
      $getimage = $requwhereest->file('image');
      $extension = $request->file('image')->getClientOriginalExtension();
      $path = public_path(). '/uploads/category/';
      File::makeDirectory($path, $mode = 0777, true, true);
      $getimage->move($path, $name.'.'.$extension);
      $image = '/uploads/category/' .$name. '.' .$extension;
    }

    $category = Category::find($request->input('id'));
    $category->name = $request->input('name');
    $category->disp_order = $request->input('disporder') ?? '1';
    $category->image = ($image ? $image : $request->input('imageOld')) ?? '';
    $category->save();

    return redirect('/admin/category')->with('success', 'Category Updated');
  }

  public function destroy($id)
  {
    $category = Category::find($id);
    $category->delete();

    return redirect('/admin/category')->with('success', 'Category Deleted');
  }

  public static function countCourses($id)
  {
    return Courses::where('cat_id', $id)->count();
  }

  
}
