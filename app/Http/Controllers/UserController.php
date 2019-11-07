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
            if(count($u->products()->get()) == 0)   {
                continue;
            }
            $products = Products::where('user_id', $u->id)->get();  
            $allImgUrl = [];
            foreach($products as $pro){
                $size = 0;
                $imgs = ProductImgs::where('p_id', $pro->id)->get();
                foreach ($imgs as $value) {
                    # code...
                    $size++;
                    if($size > 3){
                        break;
                    }
                    $allImgUrl[] = $value->url;
                }
            }

            

            $shop = [
                "user_id" => $u->id,
                "full_name" =>$u->full_name,
                "profile_img" => $u->profile_img,
                "pro_imgs" =>  $allImgUrl,
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
