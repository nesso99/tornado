<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserPass;

class Instructor extends Model
{
    protected $table = 'instructors';

    protected $fillable = array('id', 'name', 'unit_id', 'scope_id', 'academic_title', 'degree');

    protected $guarded = array('user_id');

    public static function addInstructor($request) {
        $exist = count(self::where('id', $request->id)->get()->toArray());
        if($exist > 0)
            return false;
        $instructor = new Instructor;
        $instructor->id = $request->id;
        $instructor->name = $request->name;
        $instructor->unit_id = $request->unit;

        $user = new User();
        $user->username = substr($request->email, 0, strpos($request->email, '@'));
        $password = str_random(10);
        $user->password = bcrypt($password);
        $user->email = $request->email;
        $user->role = '2';
        $user->save();
        $instructor->user_id = $user->id;
        $instructor->save();
        Mail::to($user->email)->queue(new UserPass($user->username, $password));
    }

    public static function addInstructorByFile($file)
    {
        Excel::load($file, function ($reader) {
           $reader->each(function ($sheet) {
               $row = $sheet->toArray();
               $request = [];
               $request['id'] = $row['ma_giang_vien'];
               $request['name'] = $row['ten_giang_vien'];
               $request['email'] = $row['email'];
               $unit = DB::table('units')->select('id')->where(DB::raw('LOWER(name)'), mb_strtolower($row['don_vi'], 'UTF-8'))->get();
               $request['unit'] = $unit[0]->id ? $unit[0]->id : null;
               self::addInstructor((object)$request);
           });
        });
    }
    public static function getListInstructor(){
        return Instructor::all();  
    }

    public static function updateInstructor($instructor_id, $request)
    {
        $instructor = self::find($instructor_id);
        $instructor->name = $request->name;
        $instructor->academic_title = $request->academic_title ? $request->academic_title : "";
        $instructor->degree = $request->degree ? $request->degree : "";
        $instructor->research_domain = $request->research_domain ? $request->research_domain : "";
        $instructor->save();
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function unit()
    {
        return $this->belongsTo('App\Models\Unit');
    }

    public function scopes()
    {
        return $this->belongsToMany('App\Models\Scope');
    }
    public function topic()
    {
        return $this->hasMany('App\Models\Topic');
    }
}
