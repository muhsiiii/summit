<?php

namespace App\Http\Controllers;

use App\Models\GetTouch;
use App\Models\ContactUs;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class AdminOthersController extends Controller
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

  public function touch(Request $request)
  {
    $touch = GetTouch::orderBy('id', 'desc')->paginate(10);

    $data = [
      'authuser' => Auth::user(),
      'touch'  => $touch,
      'Header' => 'Get in Touch'
    ];

    return view('admin.others.touch')->with($data);
  }

  public function contactus(Request $request)
  {
    $contactus = ContactUs::orderBy('id', 'desc')->paginate(10);

    $data = [
      'authuser' => Auth::user(),
      'contactus'  => $contactus,
      'Header' => 'Contact Us'
    ];

    return view('admin.others.contactus')->with($data);
  }

}
