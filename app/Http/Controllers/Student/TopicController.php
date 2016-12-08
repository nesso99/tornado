<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Time;
use App\Models\Topic;
use Illuminate\Support\Facades\Session;
use App\Models\Instructor;
use App\Http\Requests\PostTopicRequest;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
	public function getViewRegister(){
		$status_register = Time::getTopicStatus();
        $list_instructor = Instructor::getListInstructor();
		return view('student.topicRegister',['list_instructor'=>$list_instructor,'topic_status'=>$status_register]);
	}	
	public function postTopicStudent(PostTopicRequest $request){
		Topic::addTopic($request);
        return redirect()->route('registerTopic');
	}    
	public function listRegister(){
		$student = Auth::user()->student;
		    $topic_array = Topic::all();
        foreach($topic_array as $topic){
        	if($topic->student_id==$student->id){
        		$student_array[] = $topic->student;            
        	}
            
        }
        foreach($topic_array as $topic){
        	if($topic->student_id==$student->id){
            	$instructor_array[] = Instructor::find($topic->instructor_id);            
        	}
        }
        // dd($instructor_array);
        // $instructor_array  = Topic::all()->instructors;
        return view('student.listRegister',['topic_array'=>$topic_array,'student_array' =>$student_array,'instructor_array'=>$instructor_array]);
	}
	public function editRegister($id){
		$topic_array = Topic::all();
		$status_register = Time::getTopicStatus();
		Topic::editRegister($id);
		$topic = Topic::find($id);
		$student = $topic->student;
		$instructor = Instructor::find($topic->instructor_id);       
		 foreach($topic_array as $topic){
            	$instructor_array[] = Instructor::find($topic->instructor_id);            
        }
		return view('student.editRegister',['topic'=>$topic,'student'=>$student,'instructor'=>$instructor,'list_instructor'=>$instructor_array,'topic_status'=>$status_register]);
	}
	public function postEditRegister(PostTopicRequest $request){
		
	}
	public function cancelRegister($id){
		Topic::cancelRegister($id);
		return view('student.listRegister');
	}
}
