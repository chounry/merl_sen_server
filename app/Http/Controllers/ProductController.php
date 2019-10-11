<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Products;
use App\ProductImgs;

class ProductController extends Controller
{
    public function getAll(Request $request){
        $products = Products::select('title','sale_price', 'in_stock_amount','id')->get();
        $respone = array();
        foreach($products as $pro){
            $pro['imgUrl'] = ProductImgs::where('p_id', $pro->id)->first()->url;
            $respone[] = $pro;
        }
        return response()->json($respone);
    }

    public function getProductDetail(Request $request){
        $product = Products::select('title','description','in_stock_amount')->find($request->pro_id);
        $relatedProducts = [];
        if($product){
            return response()->json($product);
        }
        return response()->json(['code'=> 404, 'message'=> 'product does not exist']);
    }
}
