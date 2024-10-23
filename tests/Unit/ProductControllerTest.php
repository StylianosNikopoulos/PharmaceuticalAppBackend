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

    public function test_should_return_created_product()
    {
        // Prepare the data for the product.
        $data = [
            "name"=> "Sample Product",
            "category"=> "Capsule",
            "active_ingredients"=>"Silicon Dioxide",
            "batch_number"=> "731635212",
            "manufacturing_date"=> "2024-10-01",
            "expiration_date"=> "2025-10-01",  
            "status"=> "under development" 
        ];

        // Send a POST request to the product creation route.
        $response = $this->postJson('/api/products', $data);
        // Check if the response status is 201 (Created).
        $response->assertStatus(201);
        // Check if the response contains the expected JSON structure.
        $response->assertJson([
            'message' => 'Product created successfully',
            'product' => [
                "name"=> "Sample Product",
                "category"=> "Capsule",
                "active_ingredients"=>"Silicon Dioxide",
            ]
        ]);
        // Check that the product was created in the database.
        $this->assertDatabaseHas('products',  [
            "name"=> "Sample Product",
            "active_ingredients"=>"Silicon Dioxide",
        ]);
    }

    public function test_should_return_updated_product()
    {
        //Create a product in the database.
        $product = Product::create([
            "name"=> "Sample Product",
            "category"=> "Capsule",
            "active_ingredients"=>"Silicon Dioxide",
            "batch_number"=> "731635212",
            "manufacturing_date"=> "2024-10-01",
            "expiration_date"=> "2025-10-01",  
            "status"=> "under development" 
        ]);

        // Data to update the product.
        $updateData = [
            "name"=> "Updated Product", //Updated Field
            "category"=> "Capsule",
            "active_ingredients"=>"Silicon Dioxide",
            "batch_number"=> "731635212",
            "manufacturing_date"=> "2024-10-01",
            "expiration_date"=> "2025-10-01",  
            "status"=> "completed" //Updated Field
        ];

        // Act: Send a PUT request to update the product.
        $response = $this->putJson("/api/products/{$product->id}", $updateData);

        // Assert: Check if the response status is 200 (OK).
        $response->assertStatus(200);

        // Assert: Check if the response contains the updated product data.
        $response->assertJson([
            'message' => 'Product updated successfully',
            'product' => [
                "name"=> "Updated Product",
                "category"=> "Capsule",
                "active_ingredients"=>"Silicon Dioxide",
                "batch_number"=> "731635212",
                "manufacturing_date"=> "2024-10-01",
                "expiration_date"=> "2025-10-01",  
                "status"=> "completed"
            ]
        ]);

        // Assert: Check if the product was updated in the database.
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            "name"=> "Updated Product",
            "status"=> "completed" 
        ]);
    }
}

