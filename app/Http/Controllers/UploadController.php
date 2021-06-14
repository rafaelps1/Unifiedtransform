<?php

namespace App\Http\Controllers;
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
//use App\Http\Controllers\UploadHandler;
use Illuminate\Http\Request;
use App\Imports\StudentsImport;
use App\Imports\TeachersImport;
use App\Exports\StudentsExport;
use App\Exports\TeachersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
/*
 * jQuery File Upload Plugin PHP Class
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * https://opensource.org/licenses/MIT
 */

class UploadController extends Controller {

  public function upload(Request $request){

    $request->validate([
      'upload_type' => 'required',
      'file' => 'required|max:10000|mimes:doc,docx,png,jpeg,pdf,xlsx,xls,ppt,pptx,txt'
    ]);

    $upload_dir = 'school-'.auth()->user()->school_id.'/'.date("Y").'/'.$request->upload_type;
    $diskLocal = '';
    $local_filesystem = env('FILESYSTEM_DRIVER') == 'local';
    if($local_filesystem) {
      $diskLocal  = 'storage/';
      $path       = $request->file('file')->store($upload_dir);
    } else {
      $path = Storage::putFile($upload_dir, $request->file('file'));
      Storage::setVisibility($path, 'public');
    }

    if($request->upload_type == 'notice'){
      $request->validate([
        'title' => 'required|string',
      ]);
      $tb = new \App\Notice;
      $tb->file_path = $diskLocal . $path;
      $tb->title = $request->title;
      $tb->active = 1;
      $tb->school_id = auth()->user()->school_id;
      $tb->user_id = auth()->user()->id;
      $tb->save();
    }else if($request->upload_type == 'event'){
      $request->validate([
        'title' => 'required|string',
      ]);
      $tb = new \App\Event;
      $tb->file_path = $diskLocal . $path;
      $tb->title = $request->title;
      $tb->active = 1;
      $tb->school_id = auth()->user()->school_id;
      $tb->user_id = auth()->user()->id;
      $tb->save();
    } else if($request->upload_type == 'routine'){
      $request->validate([
        'title' => 'required|string',
      ]);
      $tb = new \App\Routine;
      $tb->file_path = $diskLocal . $path;
      $tb->title = $request->title;
      $tb->active = 1;
      $tb->school_id = auth()->user()->school_id;
      $tb->section_id = $request->section_id;
      $tb->user_id = auth()->user()->id;
      $tb->save();
    } else if($request->upload_type == 'syllabus'){
      $request->validate([
        'title' => 'required|string',
      ]);
      $tb = new \App\Syllabus;
      $tb->file_path = $diskLocal . $path;
      $tb->title = $request->title;
      $tb->active = 1;
      $tb->school_id = auth()->user()->school_id;
      $tb->class_id = $request->class_id;
      $tb->user_id = auth()->user()->id;
      $tb->save();
    } else if($request->upload_type == 'certificate'){
      $request->validate([
        'title' => 'required|string',
        'given_to' => 'required|int',
      ]);
      $tb = new \App\Certificate;
      $tb->file_path = $diskLocal . $path;
      $tb->title = $request->title;
      $tb->given_to = $request->given_to;
      $tb->active = 1;
      $tb->school_id = auth()->user()->school_id;
      $tb->user_id = auth()->user()->id;
      $tb->save();
    } else if($request->upload_type == 'profile' && $request->user_id > 0){
      $tb = \App\User::find($request->user_id);
      $tb->pic_path = $path;
      $tb->save();
    }

    $path_url = $diskLocal . $path;
    return ($path)?response()->json([
        'filename' => basename($path),
        'imgUrlpath' => $local_filesystem ? url($path_url) : Storage::url($path),
        'path' => $local_filesystem ? $path_url : Storage::url($path),
        'error' => false
    ]):response()->json([
        'imgUrlpath' => null,
        'path' => null,
        'error' => true
    ]);
    // $options = ['upload_dir'=>'','upload_url'=>''];
    // new UploadHandler($options);
  }

  public function import(Request $request){
        $request->validate([
            'file' => 'required|max:10000|mimes:xlsx,xls',
        ]);

        $path = $request->file('file')->getRealPath();

        try{

          if($request->type == 'student')
            Excel::import(new StudentsImport, $path);
          else if($request->type == 'teacher')
            Excel::import(new TeachersImport, $path);

        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();

            foreach ($failures as $failure) {
                $failure->row(); // row that went wrong
                $failure->attribute(); // either heading key (if using heading row concern) or column index
                $failure->errors(); // Actual error messages from Laravel validator
                $failure->values(); // The values of the row that has failed.
            }
        }
        return back()->with('status', __('Students are added successfully!'));
    }

    public function export(Request $request){
      if($request->type == 'student')
        return Excel::download(new StudentsExport($request->year), date('Y').'-students.xlsx');
      else if($request->type == 'teacher')
        return Excel::download(new TeachersExport($request->year), date('Y').'-teachers.xlsx');
    }
}
