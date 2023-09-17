<?php

namespace App\Http\Controllers;

use File;
use Session;

use App\Models\Toppers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class AdminToppersController extends Controller
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

    $toppers = Toppers::orderBy('disp_order', 'desc');
    if(isset($search) && $search != '') {
      $toppers = $toppers->where('name', 'like', "%{$search}%");
    }
    $toppers = $toppers->paginate($limit);

    $data = [
      'authuser' => Auth::user(),
      'Header' => 'Toppers',
      'toppers' => $toppers,
      'search' => $search,
      'limit' => $limit,
    ];

    return view('admin.toppers.index')->with($data);
  }

  public function create()
  {
    $myimagename = $this->generateRandName();

    $data = [
      'authuser' => Auth::user(),
      'Header' => 'Toppers',
      'SubHeader' => 'Add New Toppers',
      'myimagename' => $myimagename
    ];

    return view('admin.toppers.create')->with($data);
  }

  private function generateRandName()
  {
    $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

    $r1 = substr(str_shuffle($chars), 0, 2);
    $r2 = substr(str_shuffle($chars), 0, 2);
    $r3 = substr(str_shuffle($chars), 0, 2);
    $r4 = substr(str_shuffle($chars), 0, 2);
    $r5 = substr(str_shuffle($chars), 0, 2);

    $myimagename = $r1.date('y').$r2.date('m').$r3.date('d').$r4.date('H').$r5.date('i');
    Session::put('myimagename', $myimagename);
    return $myimagename;
  }

  public function toppersImages(Request $request)
  {
    $myimagename = Session::get('myimagename');
    $path = '/uploads/toppers/';
    File::makeDirectory($path, $mode = 0777, true, true);
    $file = $request->file($myimagename);
    $new_image_name = $myimagename.'_image'.'.jpg';
    $upload = $file->move(public_path($path), $new_image_name);
    if($upload){
      return response()->json(['status' => 1, 'msg' => 'Image has been Uploaded successfully.', 'name' => $new_image_name]);
    }else{
      return response()->json(['status' => 0, 'msg' => 'Something went wrong, try again later']);
    }
  }

  public function store(Request $request)
  {
    $image = '';
    if($request->input('setImage') == '1') {
      $image = '/uploads/toppers/'.$request->input('myimagename').'_image.jpg' ?? '';
    }

    $toppers = new Toppers();
    $toppers->disp_order = $request->input('disp_order') ?? '0';
    $toppers->name = $request->input('name') ?? '';
    $toppers->rank = $request->input('rank') ?? '1';
    $toppers->heading = $request->input('heading') ?? '';
    $toppers->image = $image ?? '';
    $toppers->save();

    return redirect('/admin/toppers')->with('success', 'Topper Added');
  }

  public function show($id)
  {
    $toppers = Toppers::find($id);

    if($toppers->logo != '') {
      $imgArr = explode('/', $toppers->logo);
      $imgPArr = explode('.', $imgArr[3]);
      $imgPArr[0] = chop($imgPArr[0], '_image');
      $myimagename = $imgPArr[0];
      Session::put('myimagename', $myimagename);
    } else {
      $myimagename = $this->generateRandName();
    }

    $data = [
      'authuser' => Auth::user(),
      'Header' => 'Toppers',
      'SubHeader' => 'Edit Topper',
      'myimagename' => $myimagename,
      'toppers' => $toppers
    ];

    return view('admin.toppers.edit')->with($data);
  }

  public function update(Request $request, $id)
  {
    $toppers = Toppers::find($id);
    $toppers->disp_order = $request->input('disp_order') ?? '0';
    $toppers->name = $request->input('name') ?? '';
    $toppers->rank = $request->input('rank') ?? '1';
    $toppers->heading = $request->input('heading') ?? '';
    if($request->input('setImage') == '1') {
      $toppers->image = '/uploads/toppers/'.$request->input('myimagename').'_image.jpg' ?? '';
    }
    $toppers->save();

    return redirect('/admin/toppers')->with('success', 'Topper Updated');
  }

  public function destroy($id)
  {
    $toppers = Toppers::find($id);
    $toppers->delete();

    return redirect('/admin/toppers')->with('success', 'Topper Deleted');
  }

}
