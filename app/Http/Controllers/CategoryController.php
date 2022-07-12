<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function get_all() {
        $data = [];

        $categories = Category::all();
        foreach ($categories as $category) {

            $attribute = 'data-id="'. $category->id .'" data-name="'. $category->name .'"';

            $actions  = '<button id="edit-category-btn" type="button" class="btn btn-link" '. $attribute .'>'.
                            '<i class="uil-edit text-success"></i>'.
                        '</button>';
            $actions .= '<button id="delete-category-btn" type="button" class="btn btn-link" '. $attribute .'>'.
                        '<i class="uil-trash text-danger"></i>'.
                        '</button>';

            $data[] = [
                'id' => $category->id,
                'name' => $category->name,
                'actions' => $actions
            ];
        }

        return response()->json(['data' => $data]);
    }

    public function add(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => ['required', Rule::unique('categories', 'name')]
        ]);

        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 401);
        }

        Category::create($request->all());
        return response(['message' => 'Category added successfully!'], 201);
    }

    public function edit(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required'
            ]);

            if($validator->fails()) {
                return response(['errors' => $validator->errors()], 401);
            }

            $category = Category::find($request->id);
            $category->update([
                'name' => $request->name
            ]);
            return response(['message' => 'Category updated successfully!'], 201);
        } catch (\Exception $exception) {
            return response(['error' => 'Sorry, can\'t do the insertion due to data constraint.'], 401);
        }
    }

    public function delete(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'user_id' => 'required',
            'password' => 'required'
        ]);

        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 401);
        }

        $user = User::find($request->user_id);
        if(!$user || !Hash::check($request->password, $user->password)) {
            return response(['errors' => ['password' => 'Password is incorrect!']], 401);
        }


        $category = Category::find($request->id);
        $category->delete();
        return response(['message' => 'Category deleted successfully!']);
    }
}
