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
use App\Buyings;

class CartController extends Controller
{
    public function insertCart(Request $request){
        $pro = Products::find($request->pro_id);

        if(!$pro->exists())
            return response()->json(['code'=>'500', 'message'=>"Product doesn't exists"]);

        $cart = Carts::where('p_id', $pro->id)->where('user_id',Auth::user()->id)->first();
        if($cart != null){
            $cart->amount = $cart->amount + $request->amount;
            $cart->created_date = date('Y-m-d H:i:s');
            $cart->save();
            return response()->json(['code' => 200,'message'=> 'old cart']); 
        }

        $cart_id = Str::random(20);
        $cart = Carts::find($cart_id);
        while($cart != null){
            $cart_id = Str::random(20);
            $cart = Carts::find($cart_id);
        }

        date_default_timezone_set("Asia/Bangkok");
        Auth::user()->carts()->attach($pro->id, ['amount'=>$request->amount, 'created_date'=> date('Y-m-d H:i:s'), 'id' => $cart_id]);
        return response()->json(['code' => 200, 'message' => 'new cart']);
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

    public function buyWithCarts(Request $request){
        $u = Auth::user();
        foreach($request->carts_id as $cart_id){
            $cart = Carts::find($cart_id);

            $buyingId = Str::random(30);
            $buying = Buyings::find($buyingId);
            while($buying != null){
                $buyingId = Str::random(30);
                $buying = Buyings::find($buyingId);
            }

            $u->buyings()->attach($cart->id,[
                'address'=> $request->address,
                'phone'=> $request->phone,
                'id'=> $buyingId, 
                'created_date'=> date('Y-m-d H:i:s')
                ]);
        }
        return response()->json(['code'=>200,'message'=>'success']);
    }

    public function buyWithProduct(Request $request){
        $u = Auth::user();

        $buyingId = Str::random(30);
        $buying = Buyings::find($buyingId);
        while($buying != null){
            $buyingId = Str::random(30);
            $buying = Buyings::find($buyingId);
        }

        $cart_id = Str::random(20);
        $cart = Carts::find($cart_id);
        while($cart != null){
            $cart_id = Str::random(20);
            $cart = Carts::find($cart_id);
        }

        $u->carts()->attach($request->pro_id, ['amount'=>$request->amount, 'created_date'=> date('Y-m-d H:i:s'), 'id' => $cart_id]);

        $u->buyings()->attach($cart_id,[
            'address'=> $request->address,
            'phone'=> $request->phone,
            'id'=> $buyingId, 
            'created_date'=> date('Y-m-d H:i:s')
        ]);

        return response()->json(['code'=>200,'message'=>'success']);
    }
}