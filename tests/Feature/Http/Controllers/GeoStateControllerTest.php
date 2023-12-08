<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\GeoState;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\GeoStateController
 */
class GeoStateControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $geoStates = GeoState::factory()->count(3)->create();

        $response = $this->get(route('geo-state.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\GeoStateController::class,
            'store',
            \App\Http\Requests\GeoStateStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $name = $this->faker->name;

        $response = $this->post(route('geo-state.store'), [
            'name' => $name,
        ]);

        $geoStates = GeoState::query()
            ->where('name', $name)
            ->get();
        $this->assertCount(1, $geoStates);
        $geoState = $geoStates->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $geoState = GeoState::factory()->create();

        $response = $this->get(route('geo-state.show', $geoState));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\GeoStateController::class,
            'update',
            \App\Http\Requests\GeoStateUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $geoState = GeoState::factory()->create();
        $name = $this->faker->name;

        $response = $this->put(route('geo-state.update', $geoState), [
            'name' => $name,
        ]);

        $geoState->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($name, $geoState->name);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $geoState = GeoState::factory()->create();

        $response = $this->delete(route('geo-state.destroy', $geoState));

        $response->assertNoContent();

        $this->assertModelMissing($geoState);
    }
}
