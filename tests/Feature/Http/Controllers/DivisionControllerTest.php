<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Department;
use App\Models\Division;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\DivisionController
 */
class DivisionControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $divisions = Division::factory()->count(3)->create();

        $response = $this->get(route('division.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\DivisionController::class,
            'store',
            \App\Http\Requests\DivisionStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $name = $this->faker->name;
        $department = Department::factory()->create();

        $response = $this->post(route('division.store'), [
            'name' => $name,
            'department_id' => $department->id,
        ]);

        $divisions = Division::query()
            ->where('name', $name)
            ->where('department_id', $department->id)
            ->get();
        $this->assertCount(1, $divisions);
        $division = $divisions->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $division = Division::factory()->create();

        $response = $this->get(route('division.show', $division));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\DivisionController::class,
            'update',
            \App\Http\Requests\DivisionUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $division = Division::factory()->create();
        $name = $this->faker->name;
        $department = Department::factory()->create();

        $response = $this->put(route('division.update', $division), [
            'name' => $name,
            'department_id' => $department->id,
        ]);

        $division->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($name, $division->name);
        $this->assertEquals($department->id, $division->department_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $division = Division::factory()->create();

        $response = $this->delete(route('division.destroy', $division));

        $response->assertNoContent();

        $this->assertModelMissing($division);
    }
}
