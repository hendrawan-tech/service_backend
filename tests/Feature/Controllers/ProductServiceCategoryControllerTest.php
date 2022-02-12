<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\ProductServiceCategory;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductServiceCategoryControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_product_service_categories()
    {
        $productServiceCategories = ProductServiceCategory::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('product-service-categories.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.product_service_categories.index')
            ->assertViewHas('productServiceCategories');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_product_service_category()
    {
        $response = $this->get(route('product-service-categories.create'));

        $response
            ->assertOk()
            ->assertViewIs('app.product_service_categories.create');
    }

    /**
     * @test
     */
    public function it_stores_the_product_service_category()
    {
        $data = ProductServiceCategory::factory()
            ->make()
            ->toArray();

        $response = $this->post(
            route('product-service-categories.store'),
            $data
        );

        $this->assertDatabaseHas('product_service_categories', $data);

        $productServiceCategory = ProductServiceCategory::latest('id')->first();

        $response->assertRedirect(
            route('product-service-categories.edit', $productServiceCategory)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_product_service_category()
    {
        $productServiceCategory = ProductServiceCategory::factory()->create();

        $response = $this->get(
            route('product-service-categories.show', $productServiceCategory)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.product_service_categories.show')
            ->assertViewHas('productServiceCategory');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_product_service_category()
    {
        $productServiceCategory = ProductServiceCategory::factory()->create();

        $response = $this->get(
            route('product-service-categories.edit', $productServiceCategory)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.product_service_categories.edit')
            ->assertViewHas('productServiceCategory');
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

        $response = $this->put(
            route('product-service-categories.update', $productServiceCategory),
            $data
        );

        $data['id'] = $productServiceCategory->id;

        $this->assertDatabaseHas('product_service_categories', $data);

        $response->assertRedirect(
            route('product-service-categories.edit', $productServiceCategory)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_product_service_category()
    {
        $productServiceCategory = ProductServiceCategory::factory()->create();

        $response = $this->delete(
            route('product-service-categories.destroy', $productServiceCategory)
        );

        $response->assertRedirect(route('product-service-categories.index'));

        $this->assertDeleted($productServiceCategory);
    }
}
