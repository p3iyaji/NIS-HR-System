<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Applicant;
use App\Models\JobPosition;
use App\Models\ShortlistedApplicant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ShortlistedApplicantController
 */
class ShortlistedApplicantControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $shortlistedApplicants = ShortlistedApplicant::factory()->count(3)->create();

        $response = $this->get(route('shortlisted-applicant.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ShortlistedApplicantController::class,
            'store',
            \App\Http\Requests\ShortlistedApplicantStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $job_position = JobPosition::factory()->create();
        $applicant = Applicant::factory()->create();
        $interview_date = $this->faker->dateTime();
        $status = $this->faker->randomElement(/** enum_attributes **/);

        $response = $this->post(route('shortlisted-applicant.store'), [
            'job_position_id' => $job_position->id,
            'applicant_id' => $applicant->id,
            'interview_date' => $interview_date,
            'status' => $status,
        ]);

        $shortlistedApplicants = ShortlistedApplicant::query()
            ->where('job_position_id', $job_position->id)
            ->where('applicant_id', $applicant->id)
            ->where('interview_date', $interview_date)
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $shortlistedApplicants);
        $shortlistedApplicant = $shortlistedApplicants->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $shortlistedApplicant = ShortlistedApplicant::factory()->create();

        $response = $this->get(route('shortlisted-applicant.show', $shortlistedApplicant));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ShortlistedApplicantController::class,
            'update',
            \App\Http\Requests\ShortlistedApplicantUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $shortlistedApplicant = ShortlistedApplicant::factory()->create();
        $job_position = JobPosition::factory()->create();
        $applicant = Applicant::factory()->create();
        $interview_date = $this->faker->dateTime();
        $status = $this->faker->randomElement(/** enum_attributes **/);

        $response = $this->put(route('shortlisted-applicant.update', $shortlistedApplicant), [
            'job_position_id' => $job_position->id,
            'applicant_id' => $applicant->id,
            'interview_date' => $interview_date,
            'status' => $status,
        ]);

        $shortlistedApplicant->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($job_position->id, $shortlistedApplicant->job_position_id);
        $this->assertEquals($applicant->id, $shortlistedApplicant->applicant_id);
        $this->assertEquals($interview_date, $shortlistedApplicant->interview_date);
        $this->assertEquals($status, $shortlistedApplicant->status);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $shortlistedApplicant = ShortlistedApplicant::factory()->create();

        $response = $this->delete(route('shortlisted-applicant.destroy', $shortlistedApplicant));

        $response->assertNoContent();

        $this->assertModelMissing($shortlistedApplicant);
    }
}
