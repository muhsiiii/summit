<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

  public function index()
  {
    if (!Auth::id() || (isset(Auth::user()->type) && Auth::user()->type != 'Admin')) {
      return redirect('/admin/login');
    }

    $data = [
      'authuser' => Auth::user(),
      'Header' => 'Dashboard',
      'SubHeader' => '',
    ];

    return view('admin.index')->with($data);
  }


  public function login()
  {
    if (Auth::id() && Auth::user()->type == 'Admin' ) {
      return redirect('/admin');
    }

    $data = [
      'Header' => 'Login',
    ];

    return view('admin.login')->with($data);
  }


  public function check(Request $req)
  {
    $remember = false;
    if($req->input('remember') == 'on') {
      $remember = true;
    }

    $user = User::where('name', $req->input('name'))
            ->where('password', md5($req->input('password')))
            ->where('type', 'Admin')
            ->where('status', 'Active')
            ->first();

    if($user) {
      Auth::loginUsingId($user->id, $remember);
      return redirect('/admin');
    } 

    return redirect('/admin/login')->with('error', 'Invalid User Name or Password!');
  }

  public function logout() {
    Auth::logout();
    return redirect('/admin/login')->with('success', 'Logout Successfully!');
  }

}
