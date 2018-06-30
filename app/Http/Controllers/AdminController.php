<?php

namespace App\Http\Controllers;

use App\Mail\NewAdmin;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function __construct() {
        //$this->middleware('IsAdmin');
    }

    public function index()
    {
        return view('admin.index');
    }

    public function getAdmins(){
        $admins = User::where('role_id', 1)->get();

        //return response()->json('this is a test in the controller');
        return \response($admins->jsonSerialize(), Response::HTTP_OK);
    }

    public function notifyNewAdmin(Request $data){
        $this->validate($data, [
          'firstname' => 'required|string|max:255',
          'lastname' => 'required|string|max:255',
          'email' => 'required|string|email|max:255|unique:users',
        ]);

        $user = User::create([
          'firstname' => $data['firstname'],
          'lastname' => $data['lastname'],
          'email' => $data['email'],
          'email_token' => User::generateVerificationCode(),
          'role_id' => 1
        ]);

        Mail::to($user)->send(new NewAdmin($user));

        //return \response(['status' => 'true'], Response::HTTP_OK);
        return \response($user->jsonSerialize(), Response::HTTP_OK);
    }


}
