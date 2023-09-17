<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Courses;
use App\Models\UserCourses;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;


class AdminUserController extends Controller
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
    $status = $request->input('status') ?? '';
    $search = $request->input('search') ?? '';
    $slimit = $request->input('slimit') ?? '10';

    $users = User::orderBy('id', 'desc')->where('type', 'User');
    if(isset($status) && $status != '' && $status != 'All') {
      $users = $users->where('status', $status);
    }
    if(isset($search) && $search != '') {
      $users = $users->where(function ($query) use ($search) {
        $query->where('name', 'like', "%{$search}%")
          ->Orwhere('email', 'like', "%{$search}%")
          ->Orwhere('phone', 'like', "%{$search}%")
          ->Orwhere('device_id', 'like', "%{$search}%");
      });
    }
    $users = $users->paginate($slimit);

    $data = [
      'authuser' => Auth::user(),
      'Header' => 'Users',
      'users'  => $users,
      'status' => $status,
      'search' => $search,
      'slimit' => $slimit
    ];

    return view('admin.users.index')->with($data);
  }


  public function create()
  {
    $data = [
      'authuser' => Auth::user(),
      'contentHeader' => 'Users',
      'contentSubHeader' => 'Add Users'
    ];

    return view('admin.users.create')->with($data);
  }

  public function store(Request $request)
  {
    $chars = "0123456789";
    $password = substr(str_shuffle($chars), 0, 8);

    $user = new User();
    $user->type = 'User';
    $user->name = $request->input('name') ?? '';
    $user->email = strtolower($request->input('email')) ?? '';
    $user->password = md5($password);
    $user->phone = $request->input('phone') ?? '';
    $user->device_id = $request->input('device_id') ?? '';
    $user->status = $request->input('status') ?? '1';
    $user->created_at = date('Y-m-d H:i:00');
    $user->updated_at = date('Y-m-d H:i:00');
    $user->save();

    // app('App\Http\Controllers\MailController')->registrationMail($user->name, $user->email, $password);

    return redirect('/admin/users')->with('success', 'User Added');
  }

  public function show($id)
  {
    $user = User::find($id);
    $data = [
      'authuser' => Auth::user(),
      'Header' => 'Users',
      'SubHeader' => 'Edit Users',
      'user' => $user
    ];

    return view('admin.users.edit')->with($data);
  }

  public function update(Request $request, $id)
  {
    $user = User::find($id);
    $user->name = $request->input('name') ?? '';
    $user->email = strtolower($request->input('email')) ?? '';
    $user->phone = $request->input('phone') ?? '';
    $user->device_id = $request->input('device_id') ?? '';
    $user->status = $request->input('status') ?? '1';
    $user->updated_at = date('Y-m-d H:i:00');
    $user->save();

    return redirect('/admin/users')->with('success', 'User Updated');
  }


  public function destroy($id)
  {
    $user = User::find($id);
    $user->delete();

    return redirect('/admin/users')->with('success', 'Distributor Removed');
  }


  public static function getUserName($id)
  {
    return User::where('id', $id)->value('name');
  }


  public function change(Request $request)
  {
    $user = User::find($request->input('user_id'));
    $user->password = md5($request->input('password'));
    $user->save();

    return redirect('/admin/users')->with('success', 'Distributor Password Updated');
  }





  public function assign(Request $request, $id)
  {    
    $no = 0;
    $page = $request->input('page') ?? 1;
    $page = $page - 1;
    if(isset($page)) { $no = $page * 10; }
    $course_id = $request->input('course_id') ?? '';
    $limit = $request->input('limit') ?? '10';

    $usercourses = UserCourses::orderBy('id', 'desc')->where('user_id', $id);
    if(isset($course_id) && $course_id != '' && $course_id != 'All') {
      $usercourses = $usercourses->where('course_id', $course_id);
    }
    $usercourses = $usercourses->paginate($limit);
    $courses = Courses::pluck('name', 'id');
    $username = User::where('id', $id)->value('name');

    $data = [
      'authuser' => Auth::user(),
      'Header' => 'Users',
      'SubHeader' => 'Assign Course',
      'usercourses' => $usercourses,
      'courses'  => $courses,
      'username' => $username,
      'course_id' => $course_id,
      'limit' => $limit,
      'no' => $no,
      'id' => $id
    ];

    return view('admin.users.assign')->with($data);
  }

  public function createUserCourse($id)
  {
    $username = User::where('id', $id)->value('name');
    $courses = Courses::pluck('name', 'id');

    $data = [
      'authuser' => Auth::user(),
      'Header' => 'Users',
      'SubHeader' => 'Create Course',
      'username' => $username,
      'courses' => $courses,
      'id' => $id
    ];

    return view('admin.users.createcourse')->with($data);
  }


  public function saveUserCourse(Request $request, $id)
  {
    $fdate = date("Y-m-d", strtotime($request->input('from_date')));
    $tdate = date("Y-m-d", strtotime($request->input('to_date')));

    $usercourse = new UserCourses();
    $usercourse->user_id = $id ?? '0';
    $usercourse->course_id = $request->input('course_id') ?? '';
    $usercourse->from_date = $fdate ?? '';
    $usercourse->to_date = $tdate ?? '';
    $usercourse->duration = $request->input('duration') ?? '1';
    $usercourse->amount = $request->input('amount') ?? '0';
    $usercourse->details = $request->input('details') ?? '';
    $usercourse->created_at = date('Y-m-d H:i:00');
    $usercourse->save();

    return redirect('/admin/users/assign/'.$id)->with('success', 'User Course Added');
  }


  public function deleteUserCourse($id, $did)
  {
    $user = UserCourses::find($did);
    $user->delete();

    return redirect('/admin/users/assign/'.$id)->with('success', 'User Course Deleted');
  }
}
