<?php

namespace App\Http\Controllers;

use File;

use App\Models\Gallery;
use App\Models\GalleryCategories;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class AdminGalleryController extends Controller
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
    $search = $request->input('search') ?? '';
    $cat_id = $request->input('cat_id') ?? '0';

    $category = Gallery::orderBy('id', 'desc');
    if(isset($search) && $search != '') {
      $category = $category->where('name', 'like', "%{$search}%");
    }
    if(isset($cat_id) && $cat_id > 0) {
      $category = $category->where('cat_id', $cat_id);
    }
    $category = $category->paginate(100);
    $gcategories = GalleryCategories::pluck('name', 'id');

    $data = [
      'authuser' => Auth::user(),
      'categories'  => $category,
      'Header' => 'Gallery',
      'subHeader' => 'Gallery',
      'search' => $search,
      'gcategories' => $gcategories,
      'cat_id' => $cat_id
    ];

    return view('admin.gallery.index')->with($data);
  }

  public function create(Request $request)
  {
    $image = '';
    $name = preg_replace("/[^a-zA-Z0-9]+/", "", $request->input('name')).'-'.rand().Auth::id();
    
    if($request->hasFile('image')) {
      $getimage = $request->file('image');
      $extension = $request->file('image')->getClientOriginalExtension();
      $path = public_path(). '/uploads/gallery/';
      File::makeDirectory($path, $mode = 0777, true, true);
      $getimage->move($path, $name.'.'.$extension);
      $image = '/uploads/gallery/' .$name. '.' .$extension;
    }

    $gallery = new Gallery();
    $gallery->name = $request->input('name');
    $gallery->cat_id = $request->input('cat_id') ?? '0';
    $gallery->image = $image ?? '';
    $gallery->save();

    return redirect('/admin/gallery')->with('success', 'New Gallery Image Created');
  }

  public function update(Request $request)
  {
    $image = '';
    $name = preg_replace("/[^a-zA-Z0-9]+/", "", $request->input('name')).'-'.rand().Auth::id();
    
    if($request->hasFile('image')) {
      $getimage = $request->file('image');
      $extension = $request->file('image')->getClientOriginalExtension();
      $path = public_path(). '/uploads/gallery/';
      File::makeDirectory($path, $mode = 0777, true, true);
      $getimage->move($path, $name.'.'.$extension);
      $image = '/uploads/gallery/' .$name. '.' .$extension;
    }

    $gallery = Gallery::find($request->input('id'));
    $gallery->name = $request->input('name');
    $gallery->cat_id = $request->input('cat_id') ?? '0';
    $gallery->image = ($image ? $image : $request->input('imageOld')) ?? '';
    $gallery->save();

    return redirect('/admin/gallery')->with('success', 'Gallery Image Updated');
  }

  public function destroy($id)
  {
    $gallery = Gallery::find($id);
    $gallery->delete();

    return redirect('/admin/gallery')->with('success', 'Gallery Image Deleted');
  }
}
