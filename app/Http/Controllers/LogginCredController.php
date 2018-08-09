<?php

namespace App\Http\Controllers;

use App\Mail\ResetPassword;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class LogginCredController extends Controller
{
    public function SendResetPassword(Request $request) {

        $this->validate(
          $request,
          [
            'email' => 'required|email'
          ]
        );

        $user = User::where('email', $request->email)->first();
        $user->email_token = User::generateVerificationCode();
        $user->save();

        Mail::to($user)->send(new ResetPassword($user));

        Session::flash('success', 'Please check your email to reset password.');

        return redirect('/');
    }

    public function receiveResetPassword($token){
        $user = User::where('email_token', $token)->first();

        if($user){
            return view('auth/passwords/reset', compact('user'));
        }else{
            return view('errors/404');
        }
    }

    public function resetPassword(Request $request){

        $this->validate($request, [
          'user_password' => 'required|min:6',
          'user_password_confirm' => 'required|same:user_password'
        ]);

        $user = User::find($request->user_id);

        $user->email_token = null;
        $user->password = bcrypt($request->user_password);
        $user->save();

        auth()->login($user);
        Session::flash('success', 'Password change successful! You are now logged in.');

        return redirect('/admin');
    }

}
