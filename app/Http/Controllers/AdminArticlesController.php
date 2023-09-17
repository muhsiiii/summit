<?php

namespace App\Http\Controllers;


use File;

use App\Models\Articles;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class AdminArticlesController extends Controller
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
    $limit = $request->input('limit') ?? '10';

    $articles = Articles::orderBy('id', 'desc');
    if(isset($search) && $search != '') {
      $articles = $articles->where('heading', 'like', "%{$search}%");
    }
    $articles = $articles->paginate($limit);

    $data = [
      'authuser' => Auth::user(),
      'Header' => 'Articles',
      'articles' => $articles,
      'search' => $search,
      'limit' => $limit
    ];

    return view('admin.articles.index')->with($data);
  }


  public function create()
  {
    $data = [
      'authuser' => Auth::user(),
      'Header' => 'Articles',
      'SubHeader' => 'Create Articles',
    ];

    return view('admin.articles.create')->with($data);
  }


  public function store(Request $request)
  {
    $image = '';
    $slugname = date('sihymd').rand();

    if($request->hasFile('image')) {
      $getimage = $request->file('image');
      $extension = $request->file('image')->getClientOriginalExtension();
      $path = public_path(). '/uploads/articles/';
      File::makeDirectory($path, $mode = 0777, true, true);
      $getimage->move($path, $slugname.'.'.$extension);
      $image = '/uploads/articles/' .$slugname.'.' .$extension;
    }

    $articles = new Articles();
    $articles->heading = $request->input('heading') ?? '';
    $articles->keyword = $request->input('keyword') ?? '';
    $articles->content = $request->input('content') ?? '';
    $articles->article_content = $request->input('article_content') ?? '';
    $articles->image = $image ?? '';
    $articles->save();

    return redirect('/admin/articles')->with('success', 'Article Created');
  }


  public function show($id)
  {
    $articles = Articles::find($id);

    $data = [
      'authuser' => Auth::user(),
      'Header' => 'Articles',
      'SubHeader' => 'Edit Article',
      'articles' => $articles,
    ];

    return view('admin.articles.edit')->with($data);
  }


  public function update(Request $request, $id)
  {
    $image = '';
    $slugname = date('sihymd').rand();

    if($request->hasFile('image')) {
      $getimage = $request->file('image');
      $extension = $request->file('image')->getClientOriginalExtension();
      $path = public_path(). '/uploads/articles/';
      File::makeDirectory($path, $mode = 0777, true, true);
      $getimage->move($path, $slugname.'.'.$extension);
      $image = '/uploads/articles/' .$slugname.'.' .$extension;
    }

    $articles = Articles::find($id);
    $articles->heading = $request->input('heading') ?? '';
    $articles->keyword = $request->input('keyword') ?? '';
    $articles->content = $request->input('content') ?? '';
    $articles->article_content = $request->input('article_content') ?? '';
    $articles->image = ($image ? $image : $request->input('imageOld')) ?? '';
    $articles->save();

    return redirect('/admin/articles')->with('success', 'Article Updated');
  }

  public function destroy($id)
  {
    $articles = Articles::find($id);
    $articles->delete();

    return redirect('/admin/articles')->with('success', 'Article Deleted');
  }
}
