<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Department;
use App\Models\Office;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\DepartmentController
 */
class DepartmentControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $departments = Department::factory()->count(3)->create();

        $response = $this->get(route('department.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\DepartmentController::class,
            'store',
            \App\Http\Requests\DepartmentStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $name = $this->faker->name;
        $office = Office::factory()->create();

        $response = $this->post(route('department.store'), [
            'name' => $name,
            'office_id' => $office->id,
        ]);

        $departments = Department::query()
            ->where('name', $name)
            ->where('office_id', $office->id)
            ->get();
        $this->assertCount(1, $departments);
        $department = $departments->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $department = Department::factory()->create();

        $response = $this->get(route('department.show', $department));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\DepartmentController::class,
            'update',
            \App\Http\Requests\DepartmentUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $department = Department::factory()->create();
        $name = $this->faker->name;
        $office = Office::factory()->create();

        $response = $this->put(route('department.update', $department), [
            'name' => $name,
            'office_id' => $office->id,
        ]);

        $department->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($name, $department->name);
        $this->assertEquals($office->id, $department->office_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $department = Department::factory()->create();

        $response = $this->delete(route('department.destroy', $department));

        $response->assertNoContent();

        $this->assertModelMissing($department);
    }
}
