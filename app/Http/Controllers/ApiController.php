<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Courses;

use Illuminate\Http\Request;

class ApiController extends Controller
{
  public function changeAdminStatus(Request $request)
  {
    $status = $request->input('status') ?? 'Active';
    $id = $request->input('id') ?? 0;

    if($id > 0) {
      $user = User::find($id);
      $user->status = $status;
      $user->save();

      echo '{"sts":"01","msg":"Status Updated"}';
    } else {
      echo '{"sts":"00","msg":"Something Went Wrong"}';
    }
  }

  public function changeCourseStatus(Request $request)
  {
    $status = $request->input('status') ?? 'Active';
    $id = $request->input('id') ?? '0';

    if($id > 0) {
      $shop = Courses::find($id);
      $shop->status = $status;
      $shop->save();

      echo '{"sts":"01","msg":"Status Updated"}';
    } else {
      echo '{"sts":"00","msg":"Something Went Wrong"}';
    }
  }

  public function getSearchCategory(Request $request)
  {
    $term = $request->input('term') ?? '';

    $cats = Category::orderBy('disp_order', 'asc')->whereRaw("name LIKE '%$term%'")->select('id','name')->limit(10)->get();
    if(count($cats) > 0) {
      foreach ($cats as $value) {
        $option = new \stdClass();
        $option->id = $value->id;
        $option->text = $value->name;
        $options[] = $option;
      }
      echo json_encode(['results' => $options ?: []]);
    }
  }

  public function getSearchCourse(Request $request)
  {
    $term = $request->input('term') ?? '';

    $courses = Courses::whereRaw("name LIKE '%$term%'")->limit(10)->get();
    if(count($courses) > 0) {
      $fdate = date('m/d/Y');
      foreach ($courses as $value) {
        $duration = "+$value->duration month";
        $tdate = date("m/d/Y", strtotime($duration, strtotime($fdate)));

        $cname = \App\Http\Controllers\AdminCourseController::getCourseCategory($value->id) ?? '';
        $cname = $value->name . ' (' . $cname . ')';

        $option = new \stdClass();
        $option->id = $value->id;
        $option->text = $cname ?? '';
        $option->amount = $value->amount;
        $option->duration = $value->duration;
        $option->fdate = $fdate;
        $option->tdate = $tdate;
        $options[] = $option;
      }
      echo json_encode(['results' => $options ?: []]);
    }
  }





}
