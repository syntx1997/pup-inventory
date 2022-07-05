<?php

namespace App\Http\Controllers;

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
        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Invalid credentials!'
            ], 401);
        }

        if(auth()->attempt($fields)) {
            $request->session()->regenerate();
            switch (auth()->user()->role) {
                case 'Administrator':
                    $link = '/dashboard/admin/index';
                    break;
                case 'Employee':
                    $link = '/dashboard/employee/index';
                    break;
                default:
                    $link = '';
                    break;
            }
        }

        return response([
            'message' => 'Logged In!',
            'link' => $link,
        ], 201);
    }

    public function check_account() {
        switch (auth()->user()->role) {
            case 'Administrator':
                $link = '/dashboard/admin/index';
                break;
            case 'Employee':
                $link = '/dashboard/employee/index';
                break;
            default:
                $link = '';
                break;
        }

        return redirect($link);
    }

    public function logout(Request $request) {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out.');
    }
}
