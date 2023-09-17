<?php

namespace App\Http\Controllers;

use App\Models\Settings;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class AdminSettingsController extends Controller
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


  public function general()
  {
    $settings = Settings::find(1);

    $data = [
      'authuser' => Auth::user(),
      'settings'  => $settings,
      'Header' => 'Settings',
      'subHeader' => 'General Settings'
    ];

    return view('admin.settings.general')->with($data);
  }

  public function saveGeneral(Request $request)
  {




    $settings = Settings::find(1);
    $settings->marquee = $request->input('marquee') ?? '';
    $settings->why_submit = $request->input('why_submit') ?? '';
    $settings->footer_desc = $request->input('footer_desc') ?? '';
    $settings->footer_about = $request->input('footer_about') ?? '';
    $settings->footer_mobile = $request->input('footer_mobile') ?? '';
    $settings->footer_email = $request->input('footer_email') ?? '';
    $settings->footer_address = $request->input('footer_address') ?? '';
    $settings->google_play = $request->input('google_play') ?? '';
    $settings->app_store = $request->input('app_store') ?? '';
    $settings->facebook_link = $request->input('facebook_link') ?? '';
    $settings->whatsapp_number = $request->input('whatsapp_number') ?? '';
    $settings->instagram_link = $request->input('instagram_link') ?? '';
    $settings->telegram_link = $request->input('telegram_link') ?? '';
    $settings->save();

    return redirect('/admin/settings/general')->with('success', 'General Settings Updated.');
  }


  public function seo()
  {
    $settings = Settings::find(1);

    $data = [
      'authuser' => Auth::user(),
      'settings'  => $settings,
      'Header' => 'Settings',
      'subHeader' => 'SEO Content'
    ];

    return view('admin.settings.seo')->with($data);
  }

  public function saveSeo(Request $request)
  {
    $settings = Settings::find(1);
    $settings->home_keyword = $request->input('home_keyword') ?? '';
    $settings->home_content = $request->input('home_content') ?? '';
    $settings->about_keyword = $request->input('about_keyword') ?? '';
    $settings->about_content = $request->input('about_content') ?? '';
    $settings->about_desc = $request->input('about_desc') ?? '';
    $settings->courses_keyword = $request->input('courses_keyword') ?? '';
    $settings->courses_content = $request->input('courses_content') ?? '';
    $settings->courses_desc = $request->input('courses_desc') ?? '';
    $settings->downloads_keyword = $request->input('downloads_keyword') ?? '';
    $settings->downloads_content = $request->input('downloads_content') ?? '';
    $settings->downloads_desc = $request->input('downloads_desc') ?? '';
    $settings->quiz_keyword = $request->input('quiz_keyword') ?? '';
    $settings->quiz_content = $request->input('quiz_content') ?? '';
    $settings->quiz_desc = $request->input('quiz_desc') ?? '';
    $settings->toppers_keyword = $request->input('toppers_keyword') ?? '';
    $settings->toppers_content = $request->input('toppers_content') ?? '';
    $settings->toppers_desc = $request->input('toppers_desc') ?? '';
    $settings->gallery_keyword = $request->input('gallery_keyword') ?? '';
    $settings->gallery_content = $request->input('gallery_content') ?? '';
    $settings->gallery_desc = $request->input('gallery_desc') ?? '';
    $settings->contact_keyword = $request->input('contact_keyword') ?? '';
    $settings->contact_content = $request->input('contact_content') ?? '';
    $settings->contact_desc = $request->input('contact_desc') ?? '';
    $settings->save();

    return redirect('/admin/settings/seo')->with('success', 'SEO Settings Updated.');
  }


}
