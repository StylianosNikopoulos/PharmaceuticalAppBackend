<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(){
        $getProducts = Product::all();
       
        if($getProducts->isEmpty()){
            return response()->json([
                'message' => 'No products found',
                'products' => []
            ],404);
        }
        
        return response()->json([
            'message' => 'Products successfully retrieved',
            'products' => $getProducts
        ],200);
    }

    public function show(){

    }

    public function store(){

    }

    public function update(){

    }

    public function destroy(){

    }
}
