<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\User;

class EmployeeController extends Controller
{
    public function get_all() {
        $data = [];

        $employees = User::where([
            'role' => 'Employee',
            'status' => 1
        ])->get();
        foreach ($employees as $employee) {
            $attributes = 'data-id="'.$employee->id.'" data-name="'.$employee->name.'" data-designation="'.$employee->designation.'" data-office="'.$employee->office.'" data-email="'.$employee->email.'"';
            $actions =  '<button id="edit-btn" type="button" class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" '.$attributes.'><i class="uil-edit text-success"></i></button>'.
                        '<button id="archive-btn" type="button" class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="top" title="Archive" '.$attributes.'><i class="uil-archive text-warning"></i></button>';

            $data[] = [
                'id' => $employee->id,
                'name' => $employee->name,
                'email' => $employee->email,
                'designation' => $employee->designation,
                'office' => $employee->office,
                'actions' => $actions
            ];
        }

        return response()->json(['data' => $data]);
    }

    public function get_all_archived() {
        $data = [];

        $employees = User::where([
            'role' => 'Employee',
            'status' => 0
        ])->get();
        foreach ($employees as $employee) {
            $attributes = 'data-id="'.$employee->id.'" data-name="'.$employee->name.'" data-designation="'.$employee->designation.'" data-office="'.$employee->office.'" data-email="'.$employee->email.'"';
            $actions =  '<button id="edit-btn" type="button" class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" '.$attributes.'><i class="uil-edit text-success"></i></button>'.
                '<button id="archive-btn" type="button" class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="top" title="Archive" '.$attributes.'><i class="uil-archive text-warning"></i></button>';

            $data[] = [
                'id' => $employee->id,
                'name' => $employee->name,
                'email' => $employee->email,
                'designation' => $employee->designation,
                'office' => $employee->office,
                'actions' => $actions
            ];
        }

        return response()->json(['data' => $data]);
    }

    public function add(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'designation' => 'required',
            'office' => 'required',
            'email' => 'required'
        ]);

        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 401);
        }

        $password = Str::random(8);

        $employee = [
            'name' => $request->name,
            'designation' => $request->designation,
            'office' => $request->office,
            'email' => $request->email,
            'password' => bcrypt($password),
            'role' => $request->role
        ];

        User::create($employee);

        return response(['message' => 'Employee added successfully!', 'password' => $password], 201);
    }

    public function edit(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'designation' => 'required',
            'office' => 'required',
            'email' => 'required',
            'id' => 'required'
        ]);

        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 401);
        }

        $employee = User::find($request->id);
        $employee->update($request->all());

        return response(['message' => 'Employee updated successfully!'], 201);
    }

    public function archive(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 401);
        }

        $employee = User::find($request->id);
        $employee->update(['status' => 0]);

        return response(['message' => 'Employee archived successfully!'], 201);
    }
}
