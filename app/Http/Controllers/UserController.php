<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAll(Request $request){
        $users = Users::select('full_name', 'profile_img','id')->get();
        $respone = array();
        foreach($users as $user){
            $respone[] = $user;
        }
        return response()->json($respone);
    }
}
