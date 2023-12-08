<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Discipline;
use App\Models\Employee;
use App\Models\ReportedBy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\DisciplineController
 */
class DisciplineControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $disciplines = Discipline::factory()->count(3)->create();

        $response = $this->get(route('discipline.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\DisciplineController::class,
            'store',
            \App\Http\Requests\DisciplineStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $employee = Employee::factory()->create();
        $offence_desc = $this->faker->text;
        $action_taken = $this->faker->text;
        $reported_by = ReportedBy::factory()->create();

        $response = $this->post(route('discipline.store'), [
            'employee_id' => $employee->id,
            'offence_desc' => $offence_desc,
            'action_taken' => $action_taken,
            'reported_by' => $reported_by->id,
        ]);

        $disciplines = Discipline::query()
            ->where('employee_id', $employee->id)
            ->where('offence_desc', $offence_desc)
            ->where('action_taken', $action_taken)
            ->where('reported_by', $reported_by->id)
            ->get();
        $this->assertCount(1, $disciplines);
        $discipline = $disciplines->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $discipline = Discipline::factory()->create();

        $response = $this->get(route('discipline.show', $discipline));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\DisciplineController::class,
            'update',
            \App\Http\Requests\DisciplineUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $discipline = Discipline::factory()->create();
        $employee = Employee::factory()->create();
        $offence_desc = $this->faker->text;
        $action_taken = $this->faker->text;
        $reported_by = ReportedBy::factory()->create();

        $response = $this->put(route('discipline.update', $discipline), [
            'employee_id' => $employee->id,
            'offence_desc' => $offence_desc,
            'action_taken' => $action_taken,
            'reported_by' => $reported_by->id,
        ]);

        $discipline->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($employee->id, $discipline->employee_id);
        $this->assertEquals($offence_desc, $discipline->offence_desc);
        $this->assertEquals($action_taken, $discipline->action_taken);
        $this->assertEquals($reported_by->id, $discipline->reported_by);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $discipline = Discipline::factory()->create();

        $response = $this->delete(route('discipline.destroy', $discipline));

        $response->assertNoContent();

        $this->assertModelMissing($discipline);
    }
}
