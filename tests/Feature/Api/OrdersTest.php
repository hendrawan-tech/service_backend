<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Orders;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrdersTest extends TestCase
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
    public function it_gets_all_orders_list()
    {
        $allOrders = Orders::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.all-orders.index'));

        $response->assertOk()->assertSee($allOrders[0]->status);
    }

    /**
     * @test
     */
    public function it_stores_the_orders()
    {
        $data = Orders::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.all-orders.store'), $data);

        $this->assertDatabaseHas('orders', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_orders()
    {
        $orders = Orders::factory()->create();

        $user = User::factory()->create();

        $data = [
            'price' => $this->faker->randomFloat(2, 0, 9999),
            'status' => $this->faker->word,
            'user_id' => $user->id,
        ];

        $response = $this->putJson(
            route('api.all-orders.update', $orders),
            $data
        );

        $data['id'] = $orders->id;

        $this->assertDatabaseHas('orders', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_orders()
    {
        $orders = Orders::factory()->create();

        $response = $this->deleteJson(route('api.all-orders.destroy', $orders));

        $this->assertDeleted($orders);

        $response->assertNoContent();
    }
}
