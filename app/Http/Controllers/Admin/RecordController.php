<?php
namespace App\Http\Controllers\Admin;

use DB;
use Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddStudentCanRequest;
use App\Models\Record;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\PostTopicRequest;

class RecordController extends Controller
{

    public function managerRecordTopic(){
        return view('admin.record.manager');
    }
    // Turn on for register Topic
    public function turnOnRecordRegister(){
        $status_on_record = true;
    }
    // Turn off register Topic
    public function turnOffRecordRegister(){
        $status_on_record  = false;
    }
    // Register Topic
    public function receiveRecordMark(){
        $user = DB::table('students')->get();
        return view('admin.record.receiveRecordMark',['student_list'=>$user]);
    }

    public function checkValidRecord(){
        return view('admin.record.checkValidRecord');
    }

    public function sendMailStudentHasTopic(){
        Record::sendMailStudentHasTopic();
        return redirect()->route('managerRecordTopic');
    }


    public function export_RecordValidList(){
        return Record::getRecordValidReport()->export('xlsx');
    }

}
