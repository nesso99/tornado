<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token',
    ];

    public function isSuperadmin() {
        return $this->attributes['role'] == 0? true:false;
    }

    public function isAdmin() {
        return $this->attributes['role'] == 1? true:false;
    }

    public function isInstructor() {
        return $this->attributes['role'] == 2? true:false;
    }

    public function isStudent() {
        return $this->attributes['role'] == 3? true:false;
    }

    // relative eloquent
    public function student()
    {
        return $this->hasOne('App\Models\Student');
    }

    public function instructor()
    {
        return $this->hasOne('App\Models\Instructor');
    }

}
