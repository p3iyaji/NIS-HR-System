<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Division;
use App\Models\Unit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\UnitController
 */
class UnitControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $units = Unit::factory()->count(3)->create();

        $response = $this->get(route('unit.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\UnitController::class,
            'store',
            \App\Http\Requests\UnitStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $division = Division::factory()->create();
        $name = $this->faker->name;

        $response = $this->post(route('unit.store'), [
            'division_id' => $division->id,
            'name' => $name,
        ]);

        $units = Unit::query()
            ->where('division_id', $division->id)
            ->where('name', $name)
            ->get();
        $this->assertCount(1, $units);
        $unit = $units->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $unit = Unit::factory()->create();

        $response = $this->get(route('unit.show', $unit));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\UnitController::class,
            'update',
            \App\Http\Requests\UnitUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $unit = Unit::factory()->create();
        $division = Division::factory()->create();
        $name = $this->faker->name;

        $response = $this->put(route('unit.update', $unit), [
            'division_id' => $division->id,
            'name' => $name,
        ]);

        $unit->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($division->id, $unit->division_id);
        $this->assertEquals($name, $unit->name);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $unit = Unit::factory()->create();

        $response = $this->delete(route('unit.destroy', $unit));

        $response->assertNoContent();

        $this->assertModelMissing($unit);
    }
}
