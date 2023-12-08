<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Applicant;
use App\Models\JobApplication;
use App\Models\JobPosition;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\JobApplicationController
 */
class JobApplicationControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $jobApplications = JobApplication::factory()->count(3)->create();

        $response = $this->get(route('job-application.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\JobApplicationController::class,
            'store',
            \App\Http\Requests\JobApplicationStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $applicant = Applicant::factory()->create();
        $job_position = JobPosition::factory()->create();
        $application_date = $this->faker->date();
        $status = $this->faker->randomElement(/** enum_attributes **/);
        $screening_date = $this->faker->date();
        $comment_note = $this->faker->text;

        $response = $this->post(route('job-application.store'), [
            'applicant_id' => $applicant->id,
            'job_position_id' => $job_position->id,
            'application_date' => $application_date,
            'status' => $status,
            'screening_date' => $screening_date,
            'comment_note' => $comment_note,
        ]);

        $jobApplications = JobApplication::query()
            ->where('applicant_id', $applicant->id)
            ->where('job_position_id', $job_position->id)
            ->where('application_date', $application_date)
            ->where('status', $status)
            ->where('screening_date', $screening_date)
            ->where('comment_note', $comment_note)
            ->get();
        $this->assertCount(1, $jobApplications);
        $jobApplication = $jobApplications->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $jobApplication = JobApplication::factory()->create();

        $response = $this->get(route('job-application.show', $jobApplication));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\JobApplicationController::class,
            'update',
            \App\Http\Requests\JobApplicationUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $jobApplication = JobApplication::factory()->create();
        $applicant = Applicant::factory()->create();
        $job_position = JobPosition::factory()->create();
        $application_date = $this->faker->date();
        $status = $this->faker->randomElement(/** enum_attributes **/);
        $screening_date = $this->faker->date();
        $comment_note = $this->faker->text;

        $response = $this->put(route('job-application.update', $jobApplication), [
            'applicant_id' => $applicant->id,
            'job_position_id' => $job_position->id,
            'application_date' => $application_date,
            'status' => $status,
            'screening_date' => $screening_date,
            'comment_note' => $comment_note,
        ]);

        $jobApplication->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($applicant->id, $jobApplication->applicant_id);
        $this->assertEquals($job_position->id, $jobApplication->job_position_id);
        $this->assertEquals(Carbon::parse($application_date), $jobApplication->application_date);
        $this->assertEquals($status, $jobApplication->status);
        $this->assertEquals(Carbon::parse($screening_date), $jobApplication->screening_date);
        $this->assertEquals($comment_note, $jobApplication->comment_note);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $jobApplication = JobApplication::factory()->create();

        $response = $this->delete(route('job-application.destroy', $jobApplication));

        $response->assertNoContent();

        $this->assertModelMissing($jobApplication);
    }
}
