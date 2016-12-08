<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
 	protected $table = 'times';

 	protected $fillable = array('topic_status','security_status');

 	public static function turnOnRegisterTopic(){
 		$time = Time::find(1);
 		$time->topic_status = 1;
 		$time->save();
 	}
 	public static function turnOffRegisterTopic(){
 		$time =  Time::find(1);
 		$time->topic_status = 0;
 		$time->save();
 	}
 	public static function getTopicStatus(){
 		$time =Time::find(1);
 		return $time->topic_status;
 	}
}
