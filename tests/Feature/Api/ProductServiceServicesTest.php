<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Service;
use App\Models\ProductService;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductServiceServicesTest extends TestCase
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
    public function it_gets_product_service_services()
    {
        $productService = ProductService::factory()->create();
        $services = Service::factory()
            ->count(2)
            ->create([
                'product_id' => $productService->id,
            ]);

        $response = $this->getJson(
            route('api.product-services.services.index', $productService)
        );

        $response->assertOk()->assertSee($services[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_product_service_services()
    {
        $productService = ProductService::factory()->create();
        $data = Service::factory()
            ->make([
                'product_id' => $productService->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.product-services.services.store', $productService),
            $data
        );

        $this->assertDatabaseHas('services', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $service = Service::latest('id')->first();

        $this->assertEquals($productService->id, $service->product_id);
    }
}
