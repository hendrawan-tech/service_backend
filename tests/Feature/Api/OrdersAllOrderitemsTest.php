<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Orders;
use App\Models\Orderitems;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrdersAllOrderitemsTest extends TestCase
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
    public function it_gets_orders_all_orderitems()
    {
        $orders = Orders::factory()->create();
        $allOrderitems = Orderitems::factory()
            ->count(2)
            ->create([
                'orders_id' => $orders->id,
            ]);

        $response = $this->getJson(
            route('api.all-orders.all-orderitems.index', $orders)
        );

        $response->assertOk()->assertSee($allOrderitems[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_orders_all_orderitems()
    {
        $orders = Orders::factory()->create();
        $data = Orderitems::factory()
            ->make([
                'orders_id' => $orders->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.all-orders.all-orderitems.store', $orders),
            $data
        );

        unset($data['quantity']);
        unset($data['orders_id']);
        unset($data['product_id']);

        $this->assertDatabaseHas('orderitems', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $orderitems = Orderitems::latest('id')->first();

        $this->assertEquals($orders->id, $orderitems->orders_id);
    }
}
