<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\CategoryProduct;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryProductControllerTest extends TestCase
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
    public function it_displays_index_view_with_category_products()
    {
        $categoryProducts = CategoryProduct::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('category-products.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.category_products.index')
            ->assertViewHas('categoryProducts');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_category_product()
    {
        $response = $this->get(route('category-products.create'));

        $response->assertOk()->assertViewIs('app.category_products.create');
    }

    /**
     * @test
     */
    public function it_stores_the_category_product()
    {
        $data = CategoryProduct::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('category-products.store'), $data);

        $this->assertDatabaseHas('category_products', $data);

        $categoryProduct = CategoryProduct::latest('id')->first();

        $response->assertRedirect(
            route('category-products.edit', $categoryProduct)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_category_product()
    {
        $categoryProduct = CategoryProduct::factory()->create();

        $response = $this->get(
            route('category-products.show', $categoryProduct)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.category_products.show')
            ->assertViewHas('categoryProduct');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_category_product()
    {
        $categoryProduct = CategoryProduct::factory()->create();

        $response = $this->get(
            route('category-products.edit', $categoryProduct)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.category_products.edit')
            ->assertViewHas('categoryProduct');
    }

    /**
     * @test
     */
    public function it_updates_the_category_product()
    {
        $categoryProduct = CategoryProduct::factory()->create();

        $data = [
            'name' => $this->faker->name,
        ];

        $response = $this->put(
            route('category-products.update', $categoryProduct),
            $data
        );

        $data['id'] = $categoryProduct->id;

        $this->assertDatabaseHas('category_products', $data);

        $response->assertRedirect(
            route('category-products.edit', $categoryProduct)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_category_product()
    {
        $categoryProduct = CategoryProduct::factory()->create();

        $response = $this->delete(
            route('category-products.destroy', $categoryProduct)
        );

        $response->assertRedirect(route('category-products.index'));

        $this->assertDeleted($categoryProduct);
    }
}
