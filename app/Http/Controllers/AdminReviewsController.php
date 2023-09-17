<?php

namespace App\Http\Controllers;

use File;

use App\Models\Reviews;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class AdminReviewsController extends Controller
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

    $reviews = Reviews::orderBy('id', 'desc');
    if(isset($search) && $search != '') {
      $reviews = $reviews->where('name', 'like', "%{$search}%");
    }
    $reviews = $reviews->paginate($limit);

    $data = [
      'authuser' => Auth::user(),
      'Header' => 'Reviews',
      'reviews' => $reviews,
      'search' => $search,
      'limit' => $limit,
    ];

    return view('admin.reviews.index')->with($data);
  }

  public function create()
  {
    $data = [
      'authuser' => Auth::user(),
      'Header' => 'Reviews',
      'SubHeader' => 'Add New Review',
    ];

    return view('admin.reviews.create')->with($data);
  }

  public function store(Request $request)
  {
    $image = '';
    $slugname = strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $request->input('name'))).'-'.Auth::id();

    if($request->hasFile('image')) {
      $getimage = $request->file('image');
      $extension = $request->file('image')->getClientOriginalExtension();
      $path = public_path(). '/uploads/reviews/';
      File::makeDirectory($path, $mode = 0777, true, true);
      $getimage->move($path, $slugname.'.'.$extension);
      $image = '/uploads/reviews/' .$slugname.'.' .$extension;
    }

    $reviews = new Reviews();
    $reviews->date = $request->input('date') ?? NULL;
    $reviews->name = $request->input('name') ?? '';
    $reviews->heading = $request->input('heading') ?? '';
    $reviews->message = $request->input('message') ?? '';
    $reviews->image = $image ?? '';
    $reviews->save();

    return redirect('/admin/reviews')->with('success', 'Review Added');
  }

  public function show($id)
  {
    $reviews = Reviews::find($id);

    $data = [
      'authuser' => Auth::user(),
      'Header' => 'Reviews',
      'SubHeader' => 'Edit Review',
      'reviews' => $reviews
    ];

    return view('admin.reviews.edit')->with($data);
  }

  public function update(Request $request, $id)
  {
    $image = '';
    $slugname = strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $request->input('name'))).'-'.Auth::id();

    if($request->hasFile('image')) {
      $getimage = $request->file('image');
      $extension = $request->file('image')->getClientOriginalExtension();
      $path = public_path(). '/uploads/reviews/';
      File::makeDirectory($path, $mode = 0777, true, true);
      $getimage->move($path, $slugname.'.'.$extension);
      $image = '/uploads/reviews/' .$slugname.'.' .$extension;
    }

    $reviews = Reviews::find($id);
    $reviews->date = $request->input('date') ?? NULL;
    $reviews->name = $request->input('name') ?? '';
    $reviews->heading = $request->input('heading') ?? '';
    $reviews->message = $request->input('message') ?? '';
    $reviews->image = ($image ? $image : $request->input('imageOld')) ?? '';
    $reviews->save();

    return redirect('/admin/reviews')->with('success', 'Review Updated');
  }

  public function destroy($id)
  {
    $reviews = Reviews::find($id);
    $reviews->delete();

    return redirect('/admin/reviews')->with('success', 'Review Deleted');
  }

}
