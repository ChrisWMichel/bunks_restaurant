<?php

namespace App\Http\Controllers;

use App\Mail\ResetPassword;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{

    public function index(){

        return view('public.index');

    }
}
