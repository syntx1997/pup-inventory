<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function add(Request $request) {
        if(! $request->item) {
            return response(['message' => 'You dont select any items to request.'], 401);
        }

        return '';
    }
}
