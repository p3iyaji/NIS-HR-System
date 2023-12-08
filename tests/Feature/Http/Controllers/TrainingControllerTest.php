<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\CreatedBy;
use App\Models\Employee;
use App\Models\Training;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\TrainingController
 */
class TrainingControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $trainings = Training::factory()->count(3)->create();

        $response = $this->get(route('training.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TrainingController::class,
            'store',
            \App\Http\Requests\TrainingStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $employee = Employee::factory()->create();
        $training_title = $this->faker->word;
        $training_instite = $this->faker->word;
        $training_location = $this->faker->word;
        $training_duration = $this->faker->word;
        $training_date_from = $this->faker->date();
        $training_date_to = $this->faker->date();
        $created_by = CreatedBy::factory()->create();

        $response = $this->post(route('training.store'), [
            'employee_id' => $employee->id,
            'training_title' => $training_title,
            'training_instite' => $training_instite,
            'training_location' => $training_location,
            'training_duration' => $training_duration,
            'training_date_from' => $training_date_from,
            'training_date_to' => $training_date_to,
            'created_by' => $created_by->id,
        ]);

        $trainings = Training::query()
            ->where('employee_id', $employee->id)
            ->where('training_title', $training_title)
            ->where('training_instite', $training_instite)
            ->where('training_location', $training_location)
            ->where('training_duration', $training_duration)
            ->where('training_date_from', $training_date_from)
            ->where('training_date_to', $training_date_to)
            ->where('created_by', $created_by->id)
            ->get();
        $this->assertCount(1, $trainings);
        $training = $trainings->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $training = Training::factory()->create();

        $response = $this->get(route('training.show', $training));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TrainingController::class,
            'update',
            \App\Http\Requests\TrainingUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $training = Training::factory()->create();
        $employee = Employee::factory()->create();
        $training_title = $this->faker->word;
        $training_instite = $this->faker->word;
        $training_location = $this->faker->word;
        $training_duration = $this->faker->word;
        $training_date_from = $this->faker->date();
        $training_date_to = $this->faker->date();
        $created_by = CreatedBy::factory()->create();

        $response = $this->put(route('training.update', $training), [
            'employee_id' => $employee->id,
            'training_title' => $training_title,
            'training_instite' => $training_instite,
            'training_location' => $training_location,
            'training_duration' => $training_duration,
            'training_date_from' => $training_date_from,
            'training_date_to' => $training_date_to,
            'created_by' => $created_by->id,
        ]);

        $training->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($employee->id, $training->employee_id);
        $this->assertEquals($training_title, $training->training_title);
        $this->assertEquals($training_instite, $training->training_instite);
        $this->assertEquals($training_location, $training->training_location);
        $this->assertEquals($training_duration, $training->training_duration);
        $this->assertEquals(Carbon::parse($training_date_from), $training->training_date_from);
        $this->assertEquals(Carbon::parse($training_date_to), $training->training_date_to);
        $this->assertEquals($created_by->id, $training->created_by);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $training = Training::factory()->create();

        $response = $this->delete(route('training.destroy', $training));

        $response->assertNoContent();

        $this->assertModelMissing($training);
    }
}
