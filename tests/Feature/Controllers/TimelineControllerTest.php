<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Timeline;

use App\Models\Service;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TimelineControllerTest extends TestCase
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
    public function it_displays_index_view_with_timelines()
    {
        $timelines = Timeline::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('timelines.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.timelines.index')
            ->assertViewHas('timelines');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_timeline()
    {
        $response = $this->get(route('timelines.create'));

        $response->assertOk()->assertViewIs('app.timelines.create');
    }

    /**
     * @test
     */
    public function it_stores_the_timeline()
    {
        $data = Timeline::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('timelines.store'), $data);

        $this->assertDatabaseHas('timelines', $data);

        $timeline = Timeline::latest('id')->first();

        $response->assertRedirect(route('timelines.edit', $timeline));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_timeline()
    {
        $timeline = Timeline::factory()->create();

        $response = $this->get(route('timelines.show', $timeline));

        $response
            ->assertOk()
            ->assertViewIs('app.timelines.show')
            ->assertViewHas('timeline');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_timeline()
    {
        $timeline = Timeline::factory()->create();

        $response = $this->get(route('timelines.edit', $timeline));

        $response
            ->assertOk()
            ->assertViewIs('app.timelines.edit')
            ->assertViewHas('timeline');
    }

    /**
     * @test
     */
    public function it_updates_the_timeline()
    {
        $timeline = Timeline::factory()->create();

        $service = Service::factory()->create();

        $data = [
            'message' => $this->faker->text(255),
            'service_id' => $service->id,
        ];

        $response = $this->put(route('timelines.update', $timeline), $data);

        $data['id'] = $timeline->id;

        $this->assertDatabaseHas('timelines', $data);

        $response->assertRedirect(route('timelines.edit', $timeline));
    }

    /**
     * @test
     */
    public function it_deletes_the_timeline()
    {
        $timeline = Timeline::factory()->create();

        $response = $this->delete(route('timelines.destroy', $timeline));

        $response->assertRedirect(route('timelines.index'));

        $this->assertDeleted($timeline);
    }
}
