<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Employee;
use App\Models\WorkHistory;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\WorkHistoryController
 */
class WorkHistoryControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $workHistories = WorkHistory::factory()->count(3)->create();

        $response = $this->get(route('work-history.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\WorkHistoryController::class,
            'store',
            \App\Http\Requests\WorkHistoryStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $employee = Employee::factory()->create();
        $organisation = $this->faker->word;
        $job_title = $this->faker->word;
        $start_date = $this->faker->date();
        $end_date = $this->faker->word;

        $response = $this->post(route('work-history.store'), [
            'employee_id' => $employee->id,
            'organisation' => $organisation,
            'job_title' => $job_title,
            'start_date' => $start_date,
            'end_date' => $end_date,
        ]);

        $workHistories = WorkHistory::query()
            ->where('employee_id', $employee->id)
            ->where('organisation', $organisation)
            ->where('job_title', $job_title)
            ->where('start_date', $start_date)
            ->where('end_date', $end_date)
            ->get();
        $this->assertCount(1, $workHistories);
        $workHistory = $workHistories->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $workHistory = WorkHistory::factory()->create();

        $response = $this->get(route('work-history.show', $workHistory));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\WorkHistoryController::class,
            'update',
            \App\Http\Requests\WorkHistoryUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $workHistory = WorkHistory::factory()->create();
        $employee = Employee::factory()->create();
        $organisation = $this->faker->word;
        $job_title = $this->faker->word;
        $start_date = $this->faker->date();
        $end_date = $this->faker->word;

        $response = $this->put(route('work-history.update', $workHistory), [
            'employee_id' => $employee->id,
            'organisation' => $organisation,
            'job_title' => $job_title,
            'start_date' => $start_date,
            'end_date' => $end_date,
        ]);

        $workHistory->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($employee->id, $workHistory->employee_id);
        $this->assertEquals($organisation, $workHistory->organisation);
        $this->assertEquals($job_title, $workHistory->job_title);
        $this->assertEquals(Carbon::parse($start_date), $workHistory->start_date);
        $this->assertEquals($end_date, $workHistory->end_date);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $workHistory = WorkHistory::factory()->create();

        $response = $this->delete(route('work-history.destroy', $workHistory));

        $response->assertNoContent();

        $this->assertModelMissing($workHistory);
    }
}
