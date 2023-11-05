<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserWelcomeController extends Controller
{
    public function WelcomeUser()
    {
        return view('auth.welcome-user');
    }
}
