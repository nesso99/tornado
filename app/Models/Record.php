<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;
use App\Mail\studentHasTopic;
use Illuminate\Support\Facades\Session;

class Record extends Model
{

    public static function sendMailStudentHasTopic(){
        $userArray = student::where('status',1)->get();
        foreach ($userArray as $user ) {
            if($user->email!=null&&$user->email!=''){
                    Mail::to($user->email)->send(new studentHasTopic());    
            }
        }
        Session::flash('flash-level','success');
        Session::flash('flash-message','Đã gửi mail thành công');
        
    }


    public static function getRecordValidReport()
    {

        return Excel::create('Danh sach sinh vien duoc bao ve', function($excel)  
        {
            $excel->sheet('Sheetname', function($sheet) 
            {
                $headings = array('STT', 'Name', 'Class', 'Training Program');
                $_data= DB::table('students')
                ->where('status','=',1)
                ->select( 'id',
                          'name',
                          'class',
                          'training_program'
                        )->get();

                $stt = 1;
                $sheet->prependRow(1,$headings);
                   foreach ($_data as &$data) {
                        $row[] = array(
                            $stt++,
                            $data->name,
                            $data->class,
                            $data->training_program,
                        );
                    }
                    $sheet->fromArray($row, null, 'A2', false, false);

            
            });
        },null,'A3',true);
    }
}