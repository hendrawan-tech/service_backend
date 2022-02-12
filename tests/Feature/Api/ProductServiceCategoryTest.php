<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ProductServiceCategory;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductServiceCategoryTest extends TestCase
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
    public function it_gets_product_service_categories_list()
    {
        $productServiceCategories = ProductServiceCategory::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(
            route('api.product-service-categories.index')
        );

        $response->assertOk()->assertSee($productServiceCategories[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_product_service_category()
    {
        $data = ProductServiceCategory::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.product-service-categories.store'),
            $data
        );

        $this->assertDatabaseHas('product_service_categories', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_product_service_category()
    {
        $productServiceCategory = ProductServiceCategory::factory()->create();

        $data = [
            'name' => $this->faker->name,
        ];

        $response = $this->putJson(
            route(
                'api.product-service-categories.update',
                $productServiceCategory
            ),
            $data
        );

        $data['id'] = $productServiceCategory->id;

        $this->assertDatabaseHas('product_service_categories', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_product_service_category()
    {
        $productServiceCategory = ProductServiceCategory::factory()->create();

        $response = $this->deleteJson(
            route(
                'api.product-service-categories.destroy',
                $productServiceCategory
            )
        );

        $this->assertDeleted($productServiceCategory);

        $response->assertNoContent();
    }
}
