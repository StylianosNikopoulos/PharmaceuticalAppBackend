<?php

namespace Tests\Unit;

use App\Http\Controllers\ProductController;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Product;
class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    // Parent function
    protected function setUp(): void {
        parent::setUp();
        $this->artisan('migrate');
    }

    //Test index function if products exists
    public function test_should_returns_all_products(){
        $products = Product::factory()->count(3)->create();
        $products = Product::all()->toArray();
        $response = $this->getJson('/api/products');
        $response->assertStatus(200);

        $response->assertJson([
            'message' => 'Products successfully retrieved',
            'products' => $products
        ]);
    }

    //Test index function if products not found
    public function test_should_returns_empty_when_products_not_found(){
        $response = $this->getJson('/api/products');
        $response->assertStatus(404);
        $response->assertJson(['message' => 'No products found', 'products' => []]);
    }

    //Test show function if show specific products
    public function test_should_return_specific_product(){
        $product = Product::factory()->create();
        $response = $this->getJson("/api/products/{$product->id}");
        $response->assertStatus(200);
        $response->assertJson([
           'message' => 'Product successfully retrieved',
            'product' => [
                'id' => $product->id,
                'name' => $product->name
            ]
        ]);

    }

    //Test show function if product not found
    public function test_should_return_empty_when_product_not_found(){
        $response = $this->getJson('/api/products/{$product->id}');
        $response->assertStatus(404);
    }
}
