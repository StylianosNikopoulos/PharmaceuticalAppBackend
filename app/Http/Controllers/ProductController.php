<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    // Retrieve all products
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

    // Retrieve details of a specific product by ID
    public function show(Product $product){
        if($product === null){
            return response()->json([
                'message' => 'No products found',
            ],404);
        }

        return response()->json([
            'message' => 'Product successfully retrieved',
            'product' => $product
        ],200);
    }

    public function store(){

    }

    public function update(){

    }

    public function destroy(){

    }
}
