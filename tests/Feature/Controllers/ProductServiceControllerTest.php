<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\ProductService;

use App\Models\ProductServiceCategory;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductServiceControllerTest extends TestCase
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
    public function it_displays_index_view_with_product_services()
    {
        $productServices = ProductService::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('product-services.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.product_services.index')
            ->assertViewHas('productServices');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_product_service()
    {
        $response = $this->get(route('product-services.create'));

        $response->assertOk()->assertViewIs('app.product_services.create');
    }

    /**
     * @test
     */
    public function it_stores_the_product_service()
    {
        $data = ProductService::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('product-services.store'), $data);

        $this->assertDatabaseHas('product_services', $data);

        $productService = ProductService::latest('id')->first();

        $response->assertRedirect(
            route('product-services.edit', $productService)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_product_service()
    {
        $productService = ProductService::factory()->create();

        $response = $this->get(route('product-services.show', $productService));

        $response
            ->assertOk()
            ->assertViewIs('app.product_services.show')
            ->assertViewHas('productService');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_product_service()
    {
        $productService = ProductService::factory()->create();

        $response = $this->get(route('product-services.edit', $productService));

        $response
            ->assertOk()
            ->assertViewIs('app.product_services.edit')
            ->assertViewHas('productService');
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

        $response = $this->put(
            route('product-services.update', $productService),
            $data
        );

        $data['id'] = $productService->id;

        $this->assertDatabaseHas('product_services', $data);

        $response->assertRedirect(
            route('product-services.edit', $productService)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_product_service()
    {
        $productService = ProductService::factory()->create();

        $response = $this->delete(
            route('product-services.destroy', $productService)
        );

        $response->assertRedirect(route('product-services.index'));

        $this->assertDeleted($productService);
    }
}
