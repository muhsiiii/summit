<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use App\Models\Notification;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class AdminNotificationController extends Controller
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
    $search = $_GET['q'] ?? '';

    $notifications = Notification::orderBy('id', 'desc');
    if(isset($search) && $search != '') {
      $notifications = $notifications->where('heading', 'like', "%{$search}%");
    }
    $notifications = $notifications->paginate(10);
    $courses = Courses::pluck('name', 'id');

    $data = [
      'authuser' => Auth::user(),
      'notifications'  => $notifications,
      'Header' => 'Notifications',
      'search' => $search,
      'courses' => $courses,
      'no' => $no
    ];

    return view('admin.notifications')->with($data);
  }


  public function create(Request $req)
  {
    $notifications = new Notification();
    $notifications->type = $req->input('type') ?? 'Global';
    $notifications->course_id = $req->input('course_id') ?? '0';
    $notifications->title = $req->input('heading') ?? '';
    $notifications->sub_title = $req->input('sub_heading') ?? '';
    $notifications->created_at = date('Y-m-d H:i:00');
    $notifications->save();

    if($req->input('type') == 'Global') {
      $type = 'global';
    } else {
      $type = 'cs'.$req->input('course_id');
    }

    // $this->pushMessage($req->input('sub_heading'), $type, $req->input('heading'));


    return redirect('/admin/notifications')->with('success', 'New Notifications Created');
  }


  public function pushMessage($message = '', $topics = 'global', $title = ''){
    $msgdata = array (
        "message" => $message,
        "title" => $title
    );
    $data = json_encode($msgdata);
    $url = 'https://fcm.googleapis.com/fcm/send';
    $fields = array (
        'to' => '/topics/'.$topics,
        'data' => ["data" => $data]
    );
    $fields = json_encode ( $fields );
    $headers = array (
        'Authorization: key=' . "AAAASzNnn8o:APA91bFcMW9dTWgAsApuj6IdFWGRyAzxtyX0h2csrs2AdiLTX-Hi3fhQoxzTLoRm0v79dzdtcc2OkMNRlLZW8Vtk4Y0OGNNUR4PEPydqxjBOxJDf0SgwrR1bRMxeA6-XGi27qjCgv1j_",
        'Content-Type: application/json'
    );

    $ch = curl_init ();
    curl_setopt ( $ch, CURLOPT_URL, $url );
    curl_setopt ( $ch, CURLOPT_POST, true );
    curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
    curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );

    $result = curl_exec ( $ch );
    curl_close ( $ch );
  }

  public function destroy($id)
  {
    $notifications = Notification::find($id);
    $notifications->delete();

    return redirect('/admin/notifications')->with('success', 'Notifications Deleted');
  }
}
