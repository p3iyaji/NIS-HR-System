<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\GeoLga;
use App\Models\GeoState;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\GeoLgaController
 */
class GeoLgaControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $geoLgas = GeoLga::factory()->count(3)->create();

        $response = $this->get(route('geo-lga.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\GeoLgaController::class,
            'store',
            \App\Http\Requests\GeoLgaStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $name = $this->faker->name;
        $geo_state = GeoState::factory()->create();

        $response = $this->post(route('geo-lga.store'), [
            'name' => $name,
            'geo_state_id' => $geo_state->id,
        ]);

        $geoLgas = GeoLga::query()
            ->where('name', $name)
            ->where('geo_state_id', $geo_state->id)
            ->get();
        $this->assertCount(1, $geoLgas);
        $geoLga = $geoLgas->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $geoLga = GeoLga::factory()->create();

        $response = $this->get(route('geo-lga.show', $geoLga));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\GeoLgaController::class,
            'update',
            \App\Http\Requests\GeoLgaUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $geoLga = GeoLga::factory()->create();
        $name = $this->faker->name;
        $geo_state = GeoState::factory()->create();

        $response = $this->put(route('geo-lga.update', $geoLga), [
            'name' => $name,
            'geo_state_id' => $geo_state->id,
        ]);

        $geoLga->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($name, $geoLga->name);
        $this->assertEquals($geo_state->id, $geoLga->geo_state_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $geoLga = GeoLga::factory()->create();

        $response = $this->delete(route('geo-lga.destroy', $geoLga));

        $response->assertNoContent();

        $this->assertModelMissing($geoLga);
    }
}
