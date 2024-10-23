<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreProductRequest;

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

    /**
     * Store a newly created product in storage.
     */
    public function store(StoreProductRequest $request){

        $product = Product::create($request->validated());

        if($product === null){
            return response()->json([
                'message' => 'Failed to create a Product',
            ],400);
        }

        return response()->json([
            'message' => 'Product created successfully',
            'product' => $product
        ],201);


    }


    /**
     * Update the specified product in storage.
     */
    public function update(UpdateProductRequest $request, Product $product){

        if($product === null){
            return response()->json([
                'message' => 'Product not found',
            ],404);
        }
        
        $product->update($request->validated());

        return response()->json([
            'message' => 'Product updated successfully',
            'product' => $product
        ],200);

    }

/**
 * Remove the specified product from storage.
 */
public function destroy(Product $product)
{
    // Check if the product exists
    if ($product === null) {
        return response()->json([
            'message' => 'Product not found',
        ], 404);
    }

    // Delete the product
    $product->delete();

    // Return a success response
    return response()->json([
        'message' => 'Product deleted successfully',
    ], 204);
}


}
