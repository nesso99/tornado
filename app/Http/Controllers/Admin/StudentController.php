<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

class StudentController extends Controller
{
    public function getStudentAdd() {
        return view('admin.students.add');
    }

    public function postStudentAdd(Request $request) {
        $file = $request->input('byFile');
        if($file) {
            // validate
            $file = fopen($request->file, "r");
            $mime = mime_content_type($file);
            $excel = [
                'application/vnd.ms-excel',
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'application/octet-stream',
            ];
            fclose($file);
            //action
            if(array_search($mime, $excel)) {
                $input = Input::file('file');
                Student::addStudentByFile($input);
                Session::flash('success', 'Đã thêm thành công giảng viên!');
            }
        } else {
            Student::addStudent($request);
            Session::flash('success', 'Đã thêm thành công giảng viên '.$request->name.'!');
        }
        return redirect()->route('getStudentAdd');
    }
}
