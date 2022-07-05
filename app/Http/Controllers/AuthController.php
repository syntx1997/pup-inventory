<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login() {
        $title = 'Login';
        $description = 'Login on your account.';
        return view('auth/login', compact('title', 'description'));
    }
}
