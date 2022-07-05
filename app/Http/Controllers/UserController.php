<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request) {
        $fields = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        // check email
        $user = User::where('email', $fields['email'])->first();

        // check password
        if(!$user || Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Invalid credentials!'
            ], 401);
        }

        return response([
            'message' => 'Logged In!'
        ], 201);
    }
}
