<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function update_info(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'designation' => 'required',
            'office' => 'required',
            'email' => 'required'
        ]);

        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 401);
        }

        $user = User::find($request->id);
        $user->update($request->all());
        return response(['message' => 'Information updated successfully']);
    }

    public function update_password(Request $request) {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required',
        ]);

        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 401);
        }

        // Get user
        $user = User::find($request->id);

        // If Password Is Incorrect
        if(!$user || !Hash::check($request->current_password, $user->password)) {
            return response(['error' => 'Password you\'ve entered is incorrect!'], 401);
        }

        // If Passwords Dot Not Matched
        if($request->new_password != $request->confirm_password) {
            return response(['error' => 'Passwords do not matched!'], 401);
        }

        $user->update(['password' => bcrypt($request->new_password)]);

        return response(['message' => 'Password has been updated!']);
    }
}
