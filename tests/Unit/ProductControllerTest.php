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
}
