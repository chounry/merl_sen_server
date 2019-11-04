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

        if($pro->in_stock_amount < $request->amount){
            return response()->json([
                'code' => 422,
                'msg' => 'The in stock amount is not enough',
                'data' => null
            ]);
        }

        $cart = Carts::where('p_id', $pro->id)->where('user_id',Auth::user()->id)->first();
        if($cart != null && $cart->bought == 0){
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
        Auth::user()->carts()->attach($pro->id, [
            'amount'=>$request->amount,
            'created_date'=> date('Y-m-d H:i:s'),
            'id' => $cart_id,
            'unit_sale_price' => $pro->sale_price
        ]);
            
        return response()->json(['code' => 200, 'message' => 'new cart']);
    }

    public function getAllCarts(){
        $products = Auth::user()->carts()->get();
        $reponses = [];
        foreach($products as $pro){
            $proImgs = array(ProductImgs::select('url')->where('p_id', $pro->id)->first()->url);
            if($pro->pivot->bought != 0){
                continue;
            }
            $newPro = [
                'pro_id'=> $pro->id,
                'sale_price' => $pro->sale_price,
                'title' => $pro->title,
                'description' => $pro->description,
                'in_stock_amount'=> $pro->in_stock_amount,
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
        Log::info($request);
        $u = Auth::user();
        foreach($request->carts_id as $cart_id){
            $cart = Carts::find($cart_id);
            $product = Products::find($cart->p_id);
            if($cart->amount > $product->in_stock_amount){
                return \response()->json([
                    'code' => 422,
                    'msg' => 'The in stock amount is not enough',
                    'data' => null
                ]);
            }
        }


        foreach($request->carts_id as $cart_id){
            // this loop will insert to buyging table
            $cart = Carts::find($cart_id);
            $cart->bought = true;
            $cart->save();
            $buyingId = Str::random(30);
            $buying = Buyings::find($buyingId);
            while($buying != null){
                $buyingId = Str::random(30);
                $buying = Buyings::find($buyingId);
            }

            $u->buyings()->attach($cart->id,[
                'full_name' => $request->full_name,
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
        $product = Products::find($request->pro_id);
        while($buying != null){
            $buyingId = Str::random(30);
            $buying = Buyings::find($buyingId);
        }
        // change the in stock amount
        if($product->in_stock_amount < $request->amount){
            return response()->json([
                'code' => 422,
                'msg' => 'The in stock amount is not enough',
                'data' => null
            ]);
        }
        // else minus the in stock amount
        $product->in_stock_amount = $product->in_stock_amount - $request->amount;
        $product->save();

        $cart_id = Str::random(20);
        $cart = Carts::find($cart_id);
        while($cart != null){
            $cart_id = Str::random(20);
            $cart = Carts::find($cart_id);
        }
        $u->carts()->attach($request->pro_id, [
            'amount'=>$request->amount,
            'created_date'=> date('Y-m-d H:i:s'),
            'id' => $cart_id,
            'bought' => true,
            'unit_sale_price' => $product->sale_price
        ]);
        $u->buyings()->attach($cart_id,[
            'full_name' => $request->full_name,
            'address'=> $request->address,
            'phone'=> $request->phone,
            'id'=> $buyingId, 
            'created_date'=> date('Y-m-d H:i:s')
        ]);
        return response()->json(['code'=>200,'message'=>'success']);
    }


    public function getBuyHistory(Request $request){
        // totalPrice, quantity,unit price, title, img, buy time, total price
        $carts = Auth::user()->buyings()->get();
        $data = [];
        foreach($carts as $c){
            $pro = Products::find($c->p_id);
            $eachResponse = [
                'title' => $pro->title,
                'buy_date_time' => $c->pivot->created_date,
                'quantity' => $c->amount,
                'unit_price' => $c->unit_sale_price,
                'img' => ProductImgs::where('p_id', $pro->id)->first()->url,
                'total_price' => $c->amount * $c->unit_sale_price
            ];
            $data[] = $eachResponse;
        }
        $responseObject = [
            'code'  => 200,
            'data' => $data
        ];

        return response()->json($responseObject);
    }
}
