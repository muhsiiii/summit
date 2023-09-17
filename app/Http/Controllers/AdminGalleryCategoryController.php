<?php

namespace App\Http\Controllers;

use File;

use App\Models\GalleryCategories;
use App\Models\Gallery;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class AdminGalleryCategoryController extends Controller
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

    $category = GalleryCategories::orderBy('disp_order', 'asc');
    if(isset($search) && $search != '') {
      $category = $category->where('name', 'like', "%{$search}%");
    }
    $category = $category->paginate(10);
    $disporder = GalleryCategories::max('disp_order');

    $data = [
      'authuser' => Auth::user(),
      'categories'  => $category,
      'Header' => 'Gallery',
      'subHeader' => 'Gallery Category',
      'search' => $search,
      'disporder' => ($disporder > 0) ? $disporder + 1 : '1',
      'no' => $no
    ];

    return view('admin.gallery.category')->with($data);
  }

  public function create(Request $request)
  {
    $category = new GalleryCategories();
    $category->name = $request->input('name') ?? '';
    $category->disp_order = $request->input('disp_order') ?? '1';
    $category->keyword = $request->input('keyword') ?? '';
    $category->content = $request->input('content') ?? '';
    $category->save();

    return redirect('/admin/gallery/category')->with('success', 'New Category Created');
  }

  public function update(Request $request)
  {
    $category = GalleryCategories::find($request->input('id'));
    $category->name = $request->input('name') ?? '';
    $category->disp_order = $request->input('disp_order') ?? '1';
    $category->keyword = $request->input('keyword') ?? '';
    $category->content = $request->input('content') ?? '';
    $category->save();

    return redirect('/admin/gallery/category')->with('success', 'Category Updated');
  }

  public function destroy($id)
  {
    $category = GalleryCategories::find($id);
    $category->delete();

    return redirect('/admin/gallery/category')->with('success', 'Category Deleted');
  }

  public static function countGallery($id)
  {
    return Gallery::where('cat_id', $id)->count();
  }

}
