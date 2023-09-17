<?php

namespace App\Http\Controllers;

use File;

use App\Models\Affairs;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class AdminAffairsController extends Controller
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

    $affairs = Affairs::orderBy('id', 'desc');
    if(isset($search) && $search != '') {
      $affairs = $affairs->where('name', 'like', "%{$search}%");
    }
    $affairs = $affairs->paginate($limit);

    $data = [
      'authuser' => Auth::user(),
      'Header' => 'Current Affairs',
      'affairs'  => $affairs,
      'search' => $search,
      'limit' => $limit
    ];

    return view('admin.affairs.index')->with($data);
  }


  public function create()
  {
    $data = [
      'authuser' => Auth::user(),
      'Header' => 'Current Affairs',
      'SubHeader' => 'Create Affairs',
    ];

    return view('admin.affairs.create')->with($data);
  }


  public function store(Request $request)
  {
    $image = '';
    $slugname = date('sihymdshi').rand();

    if($request->hasFile('image')) {
      $getimage = $request->file('image');
      $extension = $request->file('image')->getClientOriginalExtension();
      $path = public_path(). '/uploads/affairs/';
      File::makeDirectory($path, $mode = 0777, true, true);
      $getimage->move($path, $slugname.'.'.$extension);
      $image = '/uploads/affairs/' .$slugname.'.' .$extension;
    }

    $affairs = new Affairs();
    $affairs->heading = $request->input('heading') ?? '';
    $affairs->keyword = $request->input('keyword') ?? '';
    $affairs->content = $request->input('content') ?? '';
    $affairs->desc = $request->input('desc') ?? '';
    $affairs->image = $image ?? '';
    $affairs->save();

    return redirect('/admin/affairs')->with('success', 'Affairs Created');
  }


  public function show($id)
  {
    $affairs = Affairs::find($id);

    $data = [
      'authuser' => Auth::user(),
      'Header' => 'Current Affairs',
      'SubHeader' => 'Edit Affairs',
      'affairs' => $affairs,
    ];

    return view('admin.affairs.edit')->with($data);
  }


  public function update(Request $request, $id)
  {
    $image = '';
    $slugname = date('sihymdshi').rand();

    if($request->hasFile('image')) {
      $getimage = $request->file('image');
      $extension = $request->file('image')->getClientOriginalExtension();
      $path = public_path(). '/uploads/affairs/';
      File::makeDirectory($path, $mode = 0777, true, true);
      $getimage->move($path, $slugname.'.'.$extension);
      $image = '/uploads/affairs/' .$slugname.'.' .$extension;
    }

    $affairs = Affairs::find($id);
    $affairs->heading = $request->input('heading') ?? '';
    $affairs->keyword = $request->input('keyword') ?? '';
    $affairs->content = $request->input('content') ?? '';
    $affairs->desc = $request->input('desc') ?? '';
    $affairs->image = ($image ? $image : $request->input('imageOld')) ?? '';
    $affairs->save();

    return redirect('/admin/affairs')->with('success', 'Affairs Updated');
  }

  public function destroy($id)
  {
    $affairs = Affairs::find($id);
    $affairs->delete();

    return redirect('/admin/affairs')->with('success', 'Affairs Deleted');
  }

}
