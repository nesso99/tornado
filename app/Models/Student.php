<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserPass;

class Student extends Model
{
    protected $table = 'students';

    protected $fillable = array('id', 'name', 'course_id', 'branch_id', 'status', 'status_register');

    protected $guarded = array('user_id');

    public static function addStudent($request) {
        $exist = count(self::where('id', $request->id)->get()->toArray());
        if($exist > 0)
            return false;
        $student = new Student;
        $student->id = $request->id;
        $student->name = $request->name;
        $student->course_id = $request->course_id;
        $student->branch_id = $request->branch_id;

        $user = new User();
        $user->username = substr($request->email, 0, strpos($request->email, '@'));
        $password = str_random(10);
        $user->password = bcrypt($password);
        $user->email = $request->email;
        $user->role = '3'; // student
        $user->save();
        $student->user_id = $user->id;
        $student->save();
        Mail::to($user->email)->queue(new UserPass($user->username, $password));
    }

    public static function addStudentByFile($file)
    {
        Excel::load($file, function ($reader) {
            $reader->each(function ($sheet) {
                $row = $sheet->toArray();
                $request = [];
                $request['id'] = $row['ma_sinh_vien'];
                $request['name'] = $row['ten_sinh_vien'];
                $request['email'] = $row['email'];
                $course = DB::table('courses')->select('year')->where(DB::raw('LOWER(name)'), mb_strtolower($row['khoa_hoc'], 'UTF-8'))->get();
                $branch = DB::table('branches')->select('id')->where(DB::raw('LOWER(name)'), mb_strtolower($row['nganh_hoc'], 'UTF-8'))->get();
                $request['course_id'] = $course[0]->year ? $course[0]->year : null;
                $request['branch_id'] = $branch[0]->id ? $branch[0]->id : null;
                self::addStudent((object)$request);
            });
        });
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function topic(){
    	return $this->hasOne('App\Models\Topic');
    }
}
