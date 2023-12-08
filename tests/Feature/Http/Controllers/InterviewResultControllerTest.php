<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Applicant;
use App\Models\InterviewCriteria;
use App\Models\InterviewResult;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\InterviewResultController
 */
class InterviewResultControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $interviewResults = InterviewResult::factory()->count(3)->create();

        $response = $this->get(route('interview-result.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\InterviewResultController::class,
            'store',
            \App\Http\Requests\InterviewResultStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $interview_criteria = InterviewCriteria::factory()->create();
        $applicant = Applicant::factory()->create();
        $response = $this->faker->boolean;

        $response = $this->post(route('interview-result.store'), [
            'interview_criteria_id' => $interview_criteria->id,
            'applicant_id' => $applicant->id,
            'response' => $response,
        ]);

        $interviewResults = InterviewResult::query()
            ->where('interview_criteria_id', $interview_criteria->id)
            ->where('applicant_id', $applicant->id)
            ->where('response', $response)
            ->get();
        $this->assertCount(1, $interviewResults);
        $interviewResult = $interviewResults->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $interviewResult = InterviewResult::factory()->create();

        $response = $this->get(route('interview-result.show', $interviewResult));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\InterviewResultController::class,
            'update',
            \App\Http\Requests\InterviewResultUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $interviewResult = InterviewResult::factory()->create();
        $interview_criteria = InterviewCriteria::factory()->create();
        $applicant = Applicant::factory()->create();
        $response = $this->faker->boolean;

        $response = $this->put(route('interview-result.update', $interviewResult), [
            'interview_criteria_id' => $interview_criteria->id,
            'applicant_id' => $applicant->id,
            'response' => $response,
        ]);

        $interviewResult->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($interview_criteria->id, $interviewResult->interview_criteria_id);
        $this->assertEquals($applicant->id, $interviewResult->applicant_id);
        $this->assertEquals($response, $interviewResult->response);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $interviewResult = InterviewResult::factory()->create();

        $response = $this->delete(route('interview-result.destroy', $interviewResult));

        $response->assertNoContent();

        $this->assertModelMissing($interviewResult);
    }
}
