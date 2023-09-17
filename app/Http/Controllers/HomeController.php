<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use App\Models\Courses;
use App\Models\Articles;
use App\Models\Downloads;
use App\Models\Affairs;
use App\Models\GetTouch;
use App\Models\Gallery;
use App\Models\Highlights;
use App\Models\GalleryCategories;
use App\Models\ContactUs;
use App\Models\Toppers;
use App\Models\Reviews;

use Illuminate\Http\Request;

class HomeController extends Controller
{

  public function __construct(Request $request)
  {
    $this->settings = Settings::find(1);
    $this->courses = Courses::where('status', 'Active')->select('id', 'name')->limit(5)->inRandomOrder()->get();
    $this->downloads = Downloads::where('type', 'Folders')->select('id', 'name')->limit(5)->inRandomOrder()->get();
  }

  public function index()
  {
    $courses = Courses::where('status', 'Active')->orderBy('id', 'asc')->select('id', 'name')->limit(12)->inRandomOrder()->get();
    $articles = Articles::orderBy('id', 'desc')->select('id', 'heading')->limit(32)->get();
    $downloads = Downloads::where('type', 'Folders')->select('id', 'name', 'desc')->limit(12)->inRandomOrder()->get();
    $affairs = Affairs::orderBy('id', 'desc')->select('id', 'heading', 'image')->limit(3)->get();
    $settings = $this->settings;

    $data = [
      'title' => 'Summit IAS - Home Page',
      'page' => 'Home',
      'keyword' => $settings->home_keyword,
      'content' => $settings->home_content,
      'settings' => $settings,
      'fcourses' => $this->courses,
      'fdownloads' => $this->downloads,
      'courses' => $courses,
      'articles' => $articles,
      'downloads' => $downloads,
      'affairs' => $affairs,
    ];

    return view('index')->with($data);
  }

  public function getInTouch(Request $request)
  {
    $gint = new GetTouch();
    $gint->name = $request->input('name') ?? '';
    $gint->email = $request->input('email') ?? '';
    $gint->message = $request->input('message') ?? '';
    $gint->created_at = date('Y-m-d H:i:s');
    $gint->save();

    return redirect('/')->with('success', 'Your Message has been Sent.');
  }

  public function aboutUs()
  {
    $gallery = Gallery::orderBy('id', 'desc')->where('image', '!=', '')->limit(4)->get();
    $settings = $this->settings;

    $data = [
      'title' => 'Summit IAS - About Us',
      'page' => 'About Us',
      'keyword' => $settings->about_keyword,
      'content' => $settings->about_content,
      'heading' => $settings->about_desc,
      'settings' => $settings,
      'fcourses' => $this->courses,
      'fdownloads' => $this->downloads,
      'gallery' => $gallery
    ];

    return view('about')->with($data);
  }

  public function article($id)
  {
    $article = Articles::find($id);

    $data = [
      'title' => 'Summit IAS - Articles',
      'page' => 'Articles',
      'keyword' => Articles::where('id', $id)->value('keyword') ?? '',
      'content' =>  Articles::where('id', $id)->value('content') ?? '',
      'settings' => $this->settings,
      'fcourses' => $this->courses,
      'fdownloads' => $this->downloads,
      'article' => $article
    ];

    return view('article')->with($data);
  }

  public function affairs()
  {
    $affairs = Affairs::orderBy('id', 'desc')->select('id', 'heading', 'image')->limit(30)->get();
    $settings = $this->settings;

    $data = [
      'title' => 'Summit IAS - Current Affairs',
      'page' => 'Affairs',
      'keyword' => $settings->home_keyword,
      'content' => $settings->home_content,
      'settings' => $settings,
      'fcourses' => $this->courses,
      'fdownloads' => $this->downloads,
      'affairs' => $affairs
    ];

    return view('affairs')->with($data);
  }

  public function affair($id)
  {
    $affair = Affairs::find($id);

    $data = [
      'title' => 'Summit IAS - Current Affairs',
      'page' => 'Affairs',
      'keyword' => Affairs::where('id', $id)->value('keyword') ?? '',
      'content' =>  Affairs::where('id', $id)->value('content') ?? '',
      'settings' => $this->settings,
      'fcourses' => $this->courses,
      'fdownloads' => $this->downloads,
      'affair' => $affair
    ];

    return view('affair')->with($data);
  }

  public function downloads()
  {
    $downloads = Downloads::where('parent_id', '0')->select('id', 'name')->where('type', 'Folders')->get();
    $settings = $this->settings;

    $data = [
      'title' => 'Summit IAS - Downloads',
      'page' => 'Downloads',
      'keyword' => $settings->downloads_keyword,
      'content' => $settings->downloads_content,
      'heading' => $settings->downloads_desc,
      'settings' => $settings,
      'fcourses' => $this->courses,
      'fdownloads' => $this->downloads,
      'downloads' => $downloads
    ];

    return view('downloads')->with($data);
  }

  public function download($id, Request $request)
  { 
    $downloads = Downloads::orderBy('id', 'asc')->where('parent_id', $id)->get();
    $parentParentID = Downloads::where('id', $id)->value('parent_id');

    $data = [
      'title' => 'Summit IAS - Downloads',
      'page' => 'Downloads',
      'keyword' => Downloads::where('id', $id)->value('keyword') ?? '',
      'content' =>  Downloads::where('id', $id)->value('content') ?? '',
      'settings' => $this->settings,
      'fcourses' => $this->courses,
      'fdownloads' => $this->downloads,
      'downloads' => $downloads,
      'parentParentID' => $parentParentID
    ];

    return view('download')->with($data);
  }

  public function files($id, Request $request)
  {
    $downloads = Downloads::orderBy('id', 'asc')->where('parent_id', $id)->get();
    $parentParentID = Downloads::where('id', $id)->value('parent_id');

    $data = [
      'title' => 'Summit IAS - Downloads',
      'page' => 'Downloads',
      'keyword' => Downloads::where('id', $id)->value('keyword') ?? '',
      'content' =>  Downloads::where('id', $id)->value('content') ?? '',
      'settings' => $this->settings,
      'fcourses' => $this->courses,
      'fdownloads' => $this->downloads,
      'downloads' => $downloads,
      'parentParentID' => $parentParentID
    ];

    return view('files')->with($data);
  }

  public static function getSubFolders($id) {
    return Downloads::where('parent_id', $id)->select('id', 'name')->get();
  }

  public function courses()
  {
    $courses = Courses::orderBy('id', 'asc')->where('image', '!=', '')->limit(12)->get();
    $settings = $this->settings;

    $data = [
      'title' => 'Summit IAS - Courses',
      'page' => 'Courses',
      'keyword' => $settings->courses_keyword,
      'content' => $settings->courses_content,
      'heading' => $settings->courses_desc,
      'settings' => $settings,
      'fcourses' => $this->courses,
      'fdownloads' => $this->downloads,
      'courses' => $courses
    ];

    return view('courses')->with($data);
  }

  public function course($id)
  {
    $course = Courses::find($id);
    $highlights = Highlights::orderBy('disp_order', 'asc')->where('course_id', $id)->get();

    $data = [
      'title' => 'Summit IAS - Courses',
      'page' => 'Courses',
      'keyword' => Courses::where('id', $id)->value('keyword') ?? '',
      'content' =>  Courses::where('id', $id)->value('content') ?? '',
      'settings' => $this->settings,
      'fcourses' => $this->courses,
      'fdownloads' => $this->downloads,
      'course' => $course,
      'highlights' => $highlights
    ];

    return view('course')->with($data);
  }

  public function quiz()
  {
    $settings = $this->settings;

    $data = [
      'title' => 'Summit IAS - Quiz',
      'page' => 'Quiz',
      'keyword' => $settings->quiz_keyword,
      'content' => $settings->quiz_content,
      'heading' => $settings->quiz_desc,
      'settings' => $settings,
      'fcourses' => $this->courses,
      'fdownloads' => $this->downloads,
    ];

    return view('quiz')->with($data);
  }

  public function toppers()
  {
    $toppers = Toppers::orderBy('disp_order', 'desc')->get();
    $reviews = Reviews::orderBy('id', 'desc')->get();
    $settings = $this->settings;

    $data = [
      'title' => 'Summit IAS - Toppers',
      'page' => 'Toppers',
      'keyword' => $settings->toppers_keyword,
      'content' => $settings->toppers_content,
      'heading' => $settings->toppers_desc,
      'settings' => $settings,
      'fcourses' => $this->courses,
      'fdownloads' => $this->downloads,
      'toppers' => $toppers,
      'reviews' => $reviews
    ];

    return view('toppers')->with($data);
  }

  public function gallery()
  {
    $categories = GalleryCategories::orderBy('disp_order', 'desc')->get();
    $settings = $this->settings;

    $data = [
      'title' => 'Summit IAS - Gallery',
      'page' => 'Gallery',
      'keyword' => $settings->gallery_keyword,
      'content' => $settings->gallery_content,
      'heading' => $settings->gallery_desc,
      'settings' => $settings,
      'fcourses' => $this->courses,
      'fdownloads' => $this->downloads,
      'categories' => $categories
    ];

    return view('gallery')->with($data);
  }

  public static function getGallery($id) {
    return Gallery::where('cat_id', $id)->where('image', '!=', '')->inRandomOrder()->limit(12)->get();
  }

  public function contactUs()
  {
    $settings = $this->settings;

    $data = [
      'title' => 'Summit IAS - Contact Us',
      'page' => 'Contact Us',
      'keyword' => $settings->contact_keyword,
      'content' => $settings->contact_content,
      'heading' => $settings->contact_desc,
      'settings' => $settings,
      'fcourses' => $this->courses,
      'fdownloads' => $this->downloads,
    ];

    return view('contact')->with($data);
  }

  public function saveContactUs(Request $request)
  {
    $contact = new ContactUs();
    $contact->name = $request->input('name') ?? '';
    $contact->phone = $request->input('phone') ?? '';
    $contact->email = $request->input('email') ?? '';
    $contact->heading = $request->input('heading') ?? '';
    $contact->content = $request->input('content') ?? '';
    $contact->created_at = date('Y-m-d H:i:s');
    $contact->save();

    return redirect('/contactus')->with('success', 'Your Message has been Sent.');
  }
}
