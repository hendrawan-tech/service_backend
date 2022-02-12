<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ProductImage;

use App\Models\Product;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductImageTest extends TestCase
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
    public function it_gets_product_images_list()
    {
        $productImages = ProductImage::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.product-images.index'));

        $response->assertOk()->assertSee($productImages[0]->image);
    }

    /**
     * @test
     */
    public function it_stores_the_product_image()
    {
        $data = ProductImage::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.product-images.store'), $data);

        $this->assertDatabaseHas('product_images', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.product-images.update', $productImage),
            $data
        );

        $data['id'] = $productImage->id;

        $this->assertDatabaseHas('product_images', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_product_image()
    {
        $productImage = ProductImage::factory()->create();

        $response = $this->deleteJson(
            route('api.product-images.destroy', $productImage)
        );

        $this->assertDeleted($productImage);

        $response->assertNoContent();
    }
}
