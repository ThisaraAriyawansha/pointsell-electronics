<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Models\User;
use App\Mail\ForgotPasswordMail;
use Mail;
use Str;
class AuthController extends Controller
{
    public function login()
    {
        
        return view('auth.login');
    }
    public function AuthLogin(Request $request)
    {
        $remember = !empty($request->remember) ? true : false;
        if(Auth::attempt(['email' => $request->email, 'password'=>$request->password],true))
        {
            return redirect('/dashboard');
        }
        else{
            return redirect()->back()->with('error', 'Please enter currect email and password');
        }
    }
    public function forgotpassword()
    {
        return view('auth.forgot');
    }
    public function PostForgotPassword(Request $request)
    {
        $user = User::getEmailSingle($request->email);
        if(!empty($user))
        {
            $user->remember_token = Str::random(30);
            $user->save();
            Mail::to($user->email)->send(new ForgotPasswordMail($user));

            return redirect()->back()->with('success', "Please check your email and reset your password");

        }
        else
        {
            return redirect()->back()->with('error', "Email not found in the system.");
        }
    }
    public function reset($remember_token)
    {
        $user = User::getTokenSingle($remember_token);
        if(!empty($user))
        {
            $data['user'] = $user;
            return view('auth.reset', $data);
        }
        else
        {
            abort(404);
        }
    }
    public function PostReset($token, Request $request)
    {
        if($request->password == $request->cpassword)
        {
            $user = User::getTokenSingle($token);
            $user->password = Hash::make($request->password);
            $user->remember_token = Str::random(30);
            $user->save();

            return redirect(url(''))->with('success', "password successfully reset.");

        }
        else
        {
            return redirect()->back()->with('error', "password and confirm password dose not match.");
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect(url(''));
    }

}
