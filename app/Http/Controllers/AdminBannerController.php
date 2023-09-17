<?php

namespace App\Http\Controllers;

use File;

use App\Models\Banner;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class AdminBannerController extends Controller
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
  

  public function index()
  {
    $banners = Banner::orderBy('id', 'desc')->paginate(10);
    $data = [
      'authuser' => Auth::user(),
      'Header' => 'Banners',
      'banners'  => $banners
    ];
    return view('admin.banner.index')->with($data);
  }


  public function create(Request $request)
  {
    $image = '';
    $name = preg_replace("/[^a-zA-Z0-9]+/", "", $request->input('name'));
    
    if($request->hasFile('image')) {
      $getimage = $request->file('image');
      $extension = $request->file('image')->getClientOriginalExtension();
      $path = public_path(). '/uploads/banners/';
      File::makeDirectory($path, $mode = 0777, true, true);
      $getimage->move($path, $name. '.' .$extension);
      $image = '/uploads/banners/'.$name .'.'. $extension;
    }

    $banner = new Banner();
    $banner->title = $request->input('name') ?? '';
    $banner->desc = $request->input('desc') ?? '';
    $banner->button_text = $request->input('button_text') ?? '';
    $banner->image = $image ?? '';
    $banner->url = $request->input('url') ?? '';
    $banner->save();

    return redirect('/admin/banners')->with('success', 'New Banner Image Created');
  }


  public function update(Request $request)
  {
    $image = '';
    $name = preg_replace("/[^a-zA-Z0-9]+/", "", $request->input('name'));
    
    if($request->hasFile('image')) {
      $getimage = $request->file('image');
      $extension = $request->file('image')->getClientOriginalExtension();
      $path = public_path(). '/uploads/banners/';
      File::makeDirectory($path, $mode = 0777, true, true);
      $getimage->move($path, $name. '.' .$extension);
      $image = '/uploads/banners/' .$name. '.' .$extension;
    }

    $banner = Banner::find($request->input('id'));
    $banner->title = $request->input('name') ?? '';
    $banner->desc = $request->input('desc') ?? '';
    $banner->button_text = $request->input('button_text') ?? '';
    $banner->url = $request->input('url') ?? '';
    $banner->image = $image ? $image : $request->input('imageOld');
    $banner->save();

    return redirect('/admin/banners')->with('success', 'Banner Updated');
  }


  public function destroy($id)
  {
    $banner = Banner::destroy($id);

    return redirect('/admin/banners')->with('success', 'Banner Removed');
  }

}
