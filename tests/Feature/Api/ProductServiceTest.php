<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ProductService;

use App\Models\ProductServiceCategory;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductServiceTest extends TestCase
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
    public function it_gets_product_services_list()
    {
        $productServices = ProductService::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.product-services.index'));

        $response->assertOk()->assertSee($productServices[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_product_service()
    {
        $data = ProductService::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.product-services.store'), $data);

        $this->assertDatabaseHas('product_services', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_product_service()
    {
        $productService = ProductService::factory()->create();

        $productServiceCategory = ProductServiceCategory::factory()->create();
        $user = User::factory()->create();

        $data = [
            'code' => $this->faker->text(8),
            'name' => $this->faker->name,
            'brand' => $this->faker->text(30),
            'condition' => $this->faker->text(255),
            'attribute' => $this->faker->text(255),
            'problem' => $this->faker->text(255),
            'specification' => $this->faker->text,
            'status' => '',
            'product_category_id' => $productServiceCategory->id,
            'user_id' => $user->id,
        ];

        $response = $this->putJson(
            route('api.product-services.update', $productService),
            $data
        );

        $data['id'] = $productService->id;

        $this->assertDatabaseHas('product_services', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_product_service()
    {
        $productService = ProductService::factory()->create();

        $response = $this->deleteJson(
            route('api.product-services.destroy', $productService)
        );

        $this->assertDeleted($productService);

        $response->assertNoContent();
    }
}
