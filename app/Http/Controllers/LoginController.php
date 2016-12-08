<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function getLogin() {
        return view('login');
    }

    public function postLogin(LoginRequest $request ) {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password], $request->input('remember') ? true : false)) {
            $user = Auth::user();
            if($user->isAdmin() || $user->isSuperadmin())
                return redirect('admin');
            else if($user->isInstructor())
                return redirect('instructor');
            else
                return redirect('student');
        }
        return view('login');
    }

    public function getLogout () {
        Auth::logout();
        return redirect()->route('getLogin');
    }
}
