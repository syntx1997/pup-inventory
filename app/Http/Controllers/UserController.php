<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\RateLimiter;

class UserController extends Controller
{
    public function login(Request $request) {
        $this->checkTooManyFailedAttempts();

        $fields = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        // check email
        $user = User::where('email', $fields['email'])->first();

        // check password
        if(!$user || !Hash::check($fields['password'], $user->password)) {
            RateLimiter::hit($this->throttleKey(), $seconds = 60);
            return response([
                'message' => 'Invalid credentials!'
            ], 401);
        }

        if(auth()->attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1])) {
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
        } else {
            return response(['message' => 'Sorry, you account was deactivated by the admin.'], 401);
        }

        RateLimiter::clear($this->throttleKey());

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

        return response([
            'message' => 'You have been logged out!'
        ], 201);
    }

    private function throttleKey() {
        return Str::lower(request('email')) . '|' . request()->ip();
    }

    private function checkTooManyFailedAttempts() {
        if(! RateLimiter::tooManyAttempts($this->throttleKey(), 3)) {
            return;
        }

        throw new \Exception('IP address banned. Too many login attempts. You are not allowed to login for 1 minute.');
    }
}
