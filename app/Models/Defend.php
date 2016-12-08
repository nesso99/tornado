<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;
use App\Mail\studentHasTopic;
use Illuminate\Support\Facades\Session;

class Defend extends Model
{
    public static function getAssignReviewReport()
    {

    	return Excel::create('Lich phan cong bao ve', function($excel)  
        {
            $excel->sheet('Sheetname', function($sheet) 
            {
            	$headings = array('STT', 'Student', 'Class', 'Training Program', 'Time');
                $_data= DB::table('students')
                   ->join('defend_scheduler','students.id','=','defend_scheduler.id')
                    ->select('students.name','students.class', 'students.training_program', 'time')->get();
                $stt = 1;
                $sheet->prependRow(1,$headings);
                   foreach ($_data as &$data) {
                        $row[] = array(
                            $stt++,
                            $data->name,
                            $data->class,
                            $data->training_program,
                            $data->time
                        );
                    }
                    $sheet->fromArray($row, null, 'A2', false, false);

            
            });
        },null,'A3',true);
    }

    public static function getExportEnd(){
        return Excel::create('Danh sach thanh vien hoi dong', function($excel)  
        {
            $excel->sheet('Sheetname', function($sheet) 
            {
                $headings = array('STT', 'Name', 'faculty');
                $_data= DB::table('instructors')
                   ->join('units','instructors.unit_id','=','units.id')
                    ->select('instructors.name as iname','units.name as uname')->get();
                $stt = 1;
                $sheet->prependRow(1,$headings);
                   foreach ($_data as &$data) {
                        $row[] = array(
                            $stt++,
                            $data->iname,
                            $data->uname
                        );
                    }
                    $sheet->fromArray($row, null, 'A2', false, false);

            
            });
        },null,'A3',true);
    }

    public static function getSuggestExport()
    {
       $phpWord = new \PhpOffice\PhpWord\PhpWord();

        /* Note: any element you append to a document must reside inside of a Section. */

        // Adding an empty Section to the document...
        $section = $phpWord->addSection();
        // Adding Text element to the Section having font styled by default...
        $section->addText(
            '"Learn from yesterday, live for today, hope for tomorrow. '
                . 'The important thing is not to stop questioning." '
                . '(Albert Einstein)'
        );

        // Adding Text element with font customized inline...
        $section->addText(
            '"Great achievement is usually born of great sacrifice, '
                . 'and is never the result of selfishness." '
                . '(Napoleon Hill)',
            array('name' => 'Tahoma', 'size' => 10)
        );

        // Adding Text element with font customized using named font style...
        $fontStyleName = 'oneUserDefinedStyle';
        $phpWord->addFontStyle(
            $fontStyleName,
            array('name' => 'Tahoma', 'size' => 10, 'color' => '1B2232', 'bold' => true)
        );
        $section->addText(
            '"The greatest accomplishment is not in never falling, '
                . 'but in rising again after you fall." '
                . '(Vince Lombardi)',
            $fontStyleName
        );

        // Adding Text element with font customized using explicitly created font style object...
        $fontStyle = new \PhpOffice\PhpWord\Style\Font();
        $fontStyle->setBold(true);
        $fontStyle->setName('Tahoma');
        $fontStyle->setSize(13);
        $myTextElement = $section->addText('"Believe you can and you\'re halfway there." (Theodor Roosevelt)');
        $myTextElement->setFontStyle($fontStyle);

        // Saving the document as OOXML file...
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('helloWorld.docx');
        return view('admin.defend.exportEnd');
    }
}