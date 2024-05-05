<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }
    public function auth(Request $request)
    {
        $user = new User;
        // $auth = new Authentication();
        return $user->auth($request);
    }
    public function logout()
    {
        session_start();
        Session::flush();
        session_destroy();
        return redirect('login');
    }

}
