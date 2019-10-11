<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Products;
use App\ProductImgs;
use App\Categories;

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
        $product = Products::find($request->pro_id);
        $productImgs = ProductImgs::select('url', 'id')->where('p_id', $product->id)->get(); // get imgs of only product
        $responsePro = [
            'title' => $product->title,
            'description' => $product->description,
            'sale_price' => $product->sale_price,
            'in_stock_amount' => $product->in_stock_amount,
            'imgs' => $productImgs
        ];
        $productCategories = $product->categories()->get();

        $response = [];
        $relatedProducts = [];

        // get related product
        foreach($productCategories as $proCat){
            $products = Categories::find($proCat->id)->products()->take(5)->get();
            foreach($products as $pro){
                $productImgs = ProductImgs::select('url')->where('p_id', $pro->id)->first(); // get imgs of only product

                $eachRelatedPro = [
                    'title' => $pro->title,
                    'description' => $pro->description,
                    'sale_price' => $pro->sale_price,
                    'in_stock_amount' => $pro->in_stock_amount,
                    'img' => $productImgs->url
                ];
                $relatedProducts[] = $eachRelatedPro;
            }
        }
        
        $respone['product'] = $responsePro;
        $respone['related'] = $relatedProducts;
         
        if($product){
            return response()->json($respone);
        }
        return response()->json(['code'=> 404, 'message'=> 'product does not exist']);
    }
}
