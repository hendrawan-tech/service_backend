<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Orders;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrdersControllerTest extends TestCase
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
    public function it_displays_index_view_with_all_orders()
    {
        $allOrders = Orders::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('all-orders.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.all_orders.index')
            ->assertViewHas('allOrders');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_orders()
    {
        $response = $this->get(route('all-orders.create'));

        $response->assertOk()->assertViewIs('app.all_orders.create');
    }

    /**
     * @test
     */
    public function it_stores_the_orders()
    {
        $data = Orders::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('all-orders.store'), $data);

        $this->assertDatabaseHas('orders', $data);

        $orders = Orders::latest('id')->first();

        $response->assertRedirect(route('all-orders.edit', $orders));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_orders()
    {
        $orders = Orders::factory()->create();

        $response = $this->get(route('all-orders.show', $orders));

        $response
            ->assertOk()
            ->assertViewIs('app.all_orders.show')
            ->assertViewHas('orders');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_orders()
    {
        $orders = Orders::factory()->create();

        $response = $this->get(route('all-orders.edit', $orders));

        $response
            ->assertOk()
            ->assertViewIs('app.all_orders.edit')
            ->assertViewHas('orders');
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

        $response = $this->put(route('all-orders.update', $orders), $data);

        $data['id'] = $orders->id;

        $this->assertDatabaseHas('orders', $data);

        $response->assertRedirect(route('all-orders.edit', $orders));
    }

    /**
     * @test
     */
    public function it_deletes_the_orders()
    {
        $orders = Orders::factory()->create();

        $response = $this->delete(route('all-orders.destroy', $orders));

        $response->assertRedirect(route('all-orders.index'));

        $this->assertDeleted($orders);
    }
}
