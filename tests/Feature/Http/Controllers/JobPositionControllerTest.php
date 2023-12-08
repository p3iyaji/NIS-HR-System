<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\JobPosition;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\JobPositionController
 */
class JobPositionControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $jobPositions = JobPosition::factory()->count(3)->create();

        $response = $this->get(route('job-position.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\JobPositionController::class,
            'store',
            \App\Http\Requests\JobPositionStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $position_name = $this->faker->word;
        $department = $this->faker->word;
        $job_description = $this->faker->word;
        $required_qualifications = $this->faker->text;
        $applicant_deadline = $this->faker->word;
        $status = $this->faker->randomElement(/** enum_attributes **/);
        $deleted_at = $this->faker->dateTime();

        $response = $this->post(route('job-position.store'), [
            'position_name' => $position_name,
            'department' => $department,
            'job_description' => $job_description,
            'required_qualifications' => $required_qualifications,
            'applicant_deadline' => $applicant_deadline,
            'status' => $status,
            'deleted_at' => $deleted_at,
        ]);

        $jobPositions = JobPosition::query()
            ->where('position_name', $position_name)
            ->where('department', $department)
            ->where('job_description', $job_description)
            ->where('required_qualifications', $required_qualifications)
            ->where('applicant_deadline', $applicant_deadline)
            ->where('status', $status)
            ->where('deleted_at', $deleted_at)
            ->get();
        $this->assertCount(1, $jobPositions);
        $jobPosition = $jobPositions->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $jobPosition = JobPosition::factory()->create();

        $response = $this->get(route('job-position.show', $jobPosition));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\JobPositionController::class,
            'update',
            \App\Http\Requests\JobPositionUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $jobPosition = JobPosition::factory()->create();
        $position_name = $this->faker->word;
        $department = $this->faker->word;
        $job_description = $this->faker->word;
        $required_qualifications = $this->faker->text;
        $applicant_deadline = $this->faker->word;
        $status = $this->faker->randomElement(/** enum_attributes **/);
        $deleted_at = $this->faker->dateTime();

        $response = $this->put(route('job-position.update', $jobPosition), [
            'position_name' => $position_name,
            'department' => $department,
            'job_description' => $job_description,
            'required_qualifications' => $required_qualifications,
            'applicant_deadline' => $applicant_deadline,
            'status' => $status,
            'deleted_at' => $deleted_at,
        ]);

        $jobPosition->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($position_name, $jobPosition->position_name);
        $this->assertEquals($department, $jobPosition->department);
        $this->assertEquals($job_description, $jobPosition->job_description);
        $this->assertEquals($required_qualifications, $jobPosition->required_qualifications);
        $this->assertEquals($applicant_deadline, $jobPosition->applicant_deadline);
        $this->assertEquals($status, $jobPosition->status);
        $this->assertEquals($deleted_at, $jobPosition->deleted_at);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $jobPosition = JobPosition::factory()->create();

        $response = $this->delete(route('job-position.destroy', $jobPosition));

        $response->assertNoContent();

        $this->assertModelMissing($jobPosition);
    }
}
