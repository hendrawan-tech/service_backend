<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ProductService;
use App\Models\ProductServiceCategory;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductServiceCategoryProductServicesTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_product_service_category_product_services()
    {
        $productServiceCategory = ProductServiceCategory::factory()->create();
        $productServices = ProductService::factory()
            ->count(2)
            ->create([
                'product_category_id' => $productServiceCategory->id,
            ]);

        $response = $this->getJson(
            route(
                'api.product-service-categories.product-services.index',
                $productServiceCategory
            )
        );

        $response->assertOk()->assertSee($productServices[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_product_service_category_product_services()
    {
        $productServiceCategory = ProductServiceCategory::factory()->create();
        $data = ProductService::factory()
            ->make([
                'product_category_id' => $productServiceCategory->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.product-service-categories.product-services.store',
                $productServiceCategory
            ),
            $data
        );

        $this->assertDatabaseHas('product_services', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $productService = ProductService::latest('id')->first();

        $this->assertEquals(
            $productServiceCategory->id,
            $productService->product_category_id
        );
    }
}
