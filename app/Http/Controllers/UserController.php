<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function updateAddress($id, Request $request){

        $user = User::find($id);
        $user->address = $request->address;
        $user->city = $request->city;
        $user->update();

        return response($user);
    }
}
