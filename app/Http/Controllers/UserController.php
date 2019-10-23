<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use App\UserTypes;
use App\Products;
use App\ProductImgs;

class UserController extends Controller
{
    public function getAll(Request $request){
        $users = Users::where('user_type_id', UserTypes::where('name','Seller')->first()->id)->get();
        $data = [];

        foreach($users as $u){
            $products = Products::where('user_id', $u->id)->get()->take(3);
            $imgs = [];
            foreach($products as $pro){
                $imgs[] = ProductImgs::where('p_id', $pro->id)->first()->url;
            }
            $shop = [
                "user_id" => $u->id,
                "full_name" =>$u->full_name,
                "profile_img" =>'/storage/' . $u->profile_img,
                "pro_imgs" =>  $imgs,
            ];
            $data[] = $shop;
        }

        $respone = [
            "code" =>200,
            "data" => $data
        ];

        return response()->json($respone);
    }
}
