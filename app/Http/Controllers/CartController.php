<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

use App\Products;
use App\Users;
use App\ProductImgs;
use App\Carts;

class CartController extends Controller
{
    public function insertCart(Request $request){
        $pro = Products::find($request->pro_id);

        if(!$pro->exists())
            return response()->json(['code'=>'500', 'message'=>"Product doesn't exists"]);

        $cart_id = Str::random(20);
        $cart = Carts::find($cart_id);
        while($cart != null){
            $cart_id = Str::random(20);
            $cart = Carts::find($cart_id);
        }

        date_default_timezone_set("Asia/Bangkok");
        Auth::user()->carts()->attach($pro->id, ['amount'=>$request->amount, 'created_date'=> date('Y-m-d H:i:s'), 'id' => $cart_id]);
        return response()->json(['code' => 200]);
    }

    public function getAllCarts(){
        $products = Auth::user()->carts()->get();
        $reponses = [];
        foreach($products as $pro){
            $proImgs = array(ProductImgs::select('url')->where('p_id', $pro->id)->first()->url);

            $newPro = [
                'pro_id'=> $pro->id,
                'sale_price' => $pro->sale_price,
                'title' => $pro->title,
                'description' => $pro->description,
                'in_stock_amount'=>$pro->in_stock_amount,
                'imgs' => $proImgs,
                'created_date' => $pro->pivot->created_date,
                'amount' => $pro->pivot->amount,
                'cart_id' => $pro->pivot->id
            ];
            $reponses[] = $newPro;
        }

        return response()->json($reponses);
    }

    public function removeCart(Request $request){
        $cart = Carts::find($request->cart_id);
        if($cart->exists()){
            $cart->delete();
        }
        return response()->json(['code' => 200]);
    }
}
