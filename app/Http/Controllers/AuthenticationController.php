<?php


namespace App\Http\Controllers;


use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Artisan;

class AuthenticationController extends BaseController
{
    public function createAdmin(){
        $admin = new User();
        $admin->username = 'admin';
        $admin->email = 'admin@gmail.com';
        $admin->password = 'admin@123';
        $admin->save();
        return view('auth.login');
    }

    public function getLogin(){
        return view('auth.login');
    }

    public function postLogin(Request $request){
        $username = $request->uname;
        $password = $request->psw;
        $user = DB::table('users')->where('username','=',$username)
                ->where('password', '=', $password)
                ->exists();
        if ($user == true){
            $session_login = true;
            Session::put('sessionLogin', $session_login);
            return redirect()->route('index-statistical');
        }
        else{
            return view('auth.login')->with(['flash_level' => 'result_msg', 'flash_massage' => 'Sai Username/Password Thành Công !']);
        }
    }

    public function logout(){
        if (Session::has('sessionLogin')) {
            Artisan::call('cache:clear');
            Session::forget('sessionLogin');
        }
        return view('auth.login');
    }
}