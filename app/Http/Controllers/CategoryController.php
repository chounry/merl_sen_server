<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Categories;

class CategoryController extends Controller
{   
    public function getAllCategory(){
        $categories = Categories::all();
        return response()->json($categories);
    }
}
