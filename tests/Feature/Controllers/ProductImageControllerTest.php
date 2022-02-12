<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\ProductImage;

use App\Models\Product;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductImageControllerTest extends TestCase
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
    public function it_displays_index_view_with_product_images()
    {
        $productImages = ProductImage::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('product-images.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.product_images.index')
            ->assertViewHas('productImages');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_product_image()
    {
        $response = $this->get(route('product-images.create'));

        $response->assertOk()->assertViewIs('app.product_images.create');
    }

    /**
     * @test
     */
    public function it_stores_the_product_image()
    {
        $data = ProductImage::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('product-images.store'), $data);

        $this->assertDatabaseHas('product_images', $data);

        $productImage = ProductImage::latest('id')->first();

        $response->assertRedirect(route('product-images.edit', $productImage));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_product_image()
    {
        $productImage = ProductImage::factory()->create();

        $response = $this->get(route('product-images.show', $productImage));

        $response
            ->assertOk()
            ->assertViewIs('app.product_images.show')
            ->assertViewHas('productImage');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_product_image()
    {
        $productImage = ProductImage::factory()->create();

        $response = $this->get(route('product-images.edit', $productImage));

        $response
            ->assertOk()
            ->assertViewIs('app.product_images.edit')
            ->assertViewHas('productImage');
    }

    /**
     * @test
     */
    public function it_updates_the_product_image()
    {
        $productImage = ProductImage::factory()->create();

        $product = Product::factory()->create();

        $data = [
            'product_id' => $product->id,
        ];

        $response = $this->put(
            route('product-images.update', $productImage),
            $data
        );

        $data['id'] = $productImage->id;

        $this->assertDatabaseHas('product_images', $data);

        $response->assertRedirect(route('product-images.edit', $productImage));
    }

    /**
     * @test
     */
    public function it_deletes_the_product_image()
    {
        $productImage = ProductImage::factory()->create();

        $response = $this->delete(
            route('product-images.destroy', $productImage)
        );

        $response->assertRedirect(route('product-images.index'));

        $this->assertDeleted($productImage);
    }
}
