<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

use App\Products;
use App\ProductImgs;
use App\Categories;

class ProductController extends Controller
{
    public function getAll(Request $request){
        $products = Products::select('title','sale_price', 'in_stock_amount','id')->get();
        $respone = array();
        foreach($products as $pro){
            $pro['imgs'] = array(ProductImgs::where('p_id', $pro->id)->first()->url);
            $respone[] = $pro;
        }
        return response()->json($respone);
    }

    public function getProductDetail(Request $request){
        $product = Products::find($request->pro_id);
        $productImgs = ProductImgs::select('url')->where('p_id', $product->id)->get();
        $arrayOfImg = [];
        foreach($productImgs as $proImg){
            $arrayOfImg[] = $proImg->url;
        }
        // get imgs of only product
        $responsePro = [
            'id' => $product->id,
            'title' => $product->title,
            'regular_price' => $product->regular_price,
            'description' => $product->description,
            'sale_price' => $product->sale_price,
            'in_stock_amount' => $product->in_stock_amount,
            'imgs' => $arrayOfImg
        ];
        $productCategories = $product->categories()->get();

        $response = [];
        $relatedProducts = [];

        // get related product
        foreach($productCategories as $proCat){
            $products = Categories::find($proCat->id)->products()->take(5)->get();
            foreach($products as $pro){

                if($pro->id != $product->id)
                    continue;

                $productImgs = ProductImgs::select('url')->where('p_id', $pro->id)->first(); // get imgs of only product
                
                $eachRelatedPro = [
                    'title' => $pro->title,
                    'description' => $pro->description,
                    'sale_price' => $pro->sale_price,
                    'in_stock_amount' => $pro->in_stock_amount,
                    'imgs' => array($productImgs->url)
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


    public function getProductByCategory(Request $reqeust){
        $category = Categories::find($reqeust->cate_id);
        if($category == null){
            return response()->json(['message'=>'category does not exists', 'code' => 500]);
        }
        
        $products = $category->products()->get();
        $newProducts = [];
        Log::info($newProducts);

        foreach($products as $pro){

            $img = ProductImgs::where('p_id', $pro->id)->first();
            $newPro = [
                'id' => $pro->id,
                'title' => $pro->title,
                'in_stock_amount' => $pro->in_stock_amount,
                'sale_price' => $pro->sale_price,
                'imgs' => array($img->url)
            ];
            $newProducts[] = $newPro;
        }
        $response = array('data'=>$newProducts);
        return response()->json($response);
    }

    public function getListOwnProduct(Request $request){
        $products = Products::where('user_id',Auth::user()->id)->get();
        $products = [
            'code' => 200,
            'data' => $products,
        ];
        return response()->json($products);
    }
    public function getListProductBySeller(Request $request){
        $products = Products::where('user_id',$reqeust->user_id)->get();
        $products = [
            'code' => 200,
            'data' => $products,
        ];
        return response()->json($products);
    }
}
