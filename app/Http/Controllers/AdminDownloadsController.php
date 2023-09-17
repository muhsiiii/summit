<?php

namespace App\Http\Controllers;

use File;

use App\Models\Downloads;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class AdminDownloadsController extends Controller
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

    $downloads = Downloads::orderBy('id', 'asc')->where('parent_id', '0');
    if(isset($search) && $search != '') {
      $downloads = $downloads->where('name', 'like', "%{$search}%");
    }
    $downloads = $downloads->get();

    $data = [
      'authuser' => Auth::user(),
      'downloads'  => $downloads,
      'Header' => 'Downloads',
      'search' => $search
    ];

    return view('admin.downloads.index')->with($data);
  }

  public function create()
  {
    $data = [
      'authuser' => Auth::user(),
      'Header' => 'Downloads',
      'SubHeader' => 'Create Folder',
    ];

    return view('admin.downloads.create')->with($data);
  }

  public function store(Request $request)
  {
    $downloads = new Downloads();
    $downloads->parent_id = $request->input('parent_id') ?? '0';
    $downloads->name = $request->input('name') ?? '';
    $downloads->desc = $request->input('desc') ?? '';
    $downloads->keyword = $request->input('keyword') ?? '';
    $downloads->content = $request->input('content') ?? '';
    $downloads->type = $request->input('type') ?? 'Folders';
    $downloads->file_type = $request->input('file_type') ?? 'URL';
    $downloads->file_url = $request->input('file_url') ?? '';
    $downloads->save();

    return redirect('/admin/downloads')->with('success', 'New Folder Created.');
  }

  public function show($id)
  {
    $downloads = Downloads::find($id);

    $data = [
      'authuser' => Auth::user(),
      'Header' => 'Downloads',
      'SubHeader' => 'Edit Folder',
      'downloads' => $downloads
    ];

    return view('admin.downloads.edit')->with($data);
  }

  public function update(Request $request, $id)
  {
    $downloads = Downloads::find($id);
    $downloads->name = $request->input('name') ?? '';
    $downloads->desc = $request->input('desc') ?? '';
    $downloads->keyword = $request->input('keyword') ?? '';
    $downloads->content = $request->input('content') ?? '';
    $downloads->file_type = $request->input('file_type') ?? 'URL';
    $downloads->file_url = $request->input('file_url') ?? '';
    $downloads->save();

    return redirect('/admin/downloads/'.$downloads->parent_id)->with('success', 'Folder Updated');
  }

  public function destroy($id)
  {
    $downloads = Downloads::find($id);
    $downloads->delete();

    return redirect('/admin/downloads')->with('success', 'Folder Deleted');
  }

  public static function countFolders($id)
  {
    return Downloads::where('parent_id', $id)->count() ?? '0';
  }

  public function folder($id, Request $request)
  { 
    $search = $request->input('search') ?? '';

    $downloads = Downloads::orderBy('id', 'asc')->where('parent_id', $id);
    if(isset($search) && $search != '') {
      $downloads = $downloads->where('name', 'like', "%{$search}%");
    }
    $downloads = $downloads->get();

    $parentParentID = Downloads::where('id', $id)->value('parent_id');


    $data = [
      'authuser' => Auth::user(),
      'downloads'  => $downloads,
      'Header' => 'Downloads',
      'SubHeader' => 'Sub Folders',
      'search' => $search,
      'id' => $id,
      'parentParentID' => $parentParentID
    ];

    return view('admin.downloads.folder')->with($data);
  }

  public function createFolder($id)
  {
    $data = [
      'authuser' => Auth::user(),
      'Header' => 'Downloads',
      'SubHeader' => 'Create Sub Folder',
      'id' => $id
    ];

    return view('admin.downloads.create-folder')->with($data);
  }

  public function storeFolder($id, Request $request)
  {
    $downloads = new Downloads();
    $downloads->parent_id = $id ?? '0';
    $downloads->name = $request->input('name') ?? '';
    $downloads->desc = $request->input('desc') ?? '';
    $downloads->keyword = $request->input('keyword') ?? '';
    $downloads->content = $request->input('content') ?? '';
    $downloads->type = $request->input('type') ?? 'Folders';
    $downloads->file_type = $request->input('file_type') ?? 'URL';
    $downloads->file_url = $request->input('file_url') ?? '';
    $downloads->save();

    return redirect('/admin/downloads/'.$id)->with('success', 'New Folder Created.');
  }

  public function destroyFolder($id, $fid)
  {
    $downloads = Downloads::find($fid);
    $downloads->delete();

    return redirect('/admin/downloads/'.$id)->with('success', 'Folder Deleted');
  }

  public function files($id, Request $request)
  { 
    $search = $request->input('search') ?? '';

    $downloads = Downloads::orderBy('id', 'asc')->where('parent_id', $id);
    if(isset($search) && $search != '') {
      $downloads = $downloads->where('name', 'like', "%{$search}%");
    }
    $downloads = $downloads->get();

    $parentParentID = Downloads::where('id', $id)->value('parent_id');


    $data = [
      'authuser' => Auth::user(),
      'downloads'  => $downloads,
      'Header' => 'Downloads',
      'SubHeader' => 'Files',
      'search' => $search,
      'id' => $id,
      'parentParentID' => $parentParentID
    ];

    return view('admin.downloads.files')->with($data);
  }

  public function createFiles($id)
  {
    $data = [
      'authuser' => Auth::user(),
      'Header' => 'Downloads',
      'SubHeader' => 'Create Files',
      'id' => $id
    ];

    return view('admin.downloads.create-files')->with($data);
  }

  public function storeFiles($id, Request $request)
  {
    $url = '';
    $slugname = date('sdimHYsih');
    if($request->input('file_type') == 'PDF') {
      if($request->hasFile('file')) {
        $getimage = $request->file('file');
        $extension = $request->file('file')->getClientOriginalExtension();
        $path = public_path(). '/uploads/downloads/';
        File::makeDirectory($path, $mode = 0777, true, true);
        $getimage->move($path, $slugname.'.'.$extension);
        $url = '/uploads/downloads/' .$slugname.'.' .$extension;
      }
    }

    $downloads = new Downloads();
    $downloads->parent_id = $id ?? '0';
    $downloads->name = $request->input('name') ?? '';
    $downloads->desc = $request->input('desc') ?? '';
    $downloads->keyword = $request->input('keyword') ?? '';
    $downloads->content = $request->input('content') ?? '';
    $downloads->type = $request->input('type') ?? 'Folders';
    $downloads->file_type = $request->input('file_type') ?? 'URL';
    $downloads->file_url = $request->input('file_url') ?? $url ?? '';
    $downloads->save();

    return redirect('/admin/downloads/files/'.$id)->with('success', 'New Files Created.');
  }

  public function destroyFile($id, $fid)
  {
    $downloads = Downloads::find($fid);
    $downloads->delete();

    return redirect('/admin/downloads/files/'.$id)->with('success', 'File Deleted');
  }


}
