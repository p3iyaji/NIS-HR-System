<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Applicant;
use App\Models\WorkExperience;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\WorkExperienceController
 */
class WorkExperienceControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $workExperiences = WorkExperience::factory()->count(3)->create();

        $response = $this->get(route('work-experience.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\WorkExperienceController::class,
            'store',
            \App\Http\Requests\WorkExperienceStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $applicant = Applicant::factory()->create();
        $organisation = $this->faker->word;
        $job_title = $this->faker->word;
        $start_date = $this->faker->date();
        $end_date = $this->faker->word;

        $response = $this->post(route('work-experience.store'), [
            'applicant_id' => $applicant->id,
            'organisation' => $organisation,
            'job_title' => $job_title,
            'start_date' => $start_date,
            'end_date' => $end_date,
        ]);

        $workExperiences = WorkExperience::query()
            ->where('applicant_id', $applicant->id)
            ->where('organisation', $organisation)
            ->where('job_title', $job_title)
            ->where('start_date', $start_date)
            ->where('end_date', $end_date)
            ->get();
        $this->assertCount(1, $workExperiences);
        $workExperience = $workExperiences->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $workExperience = WorkExperience::factory()->create();

        $response = $this->get(route('work-experience.show', $workExperience));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\WorkExperienceController::class,
            'update',
            \App\Http\Requests\WorkExperienceUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $workExperience = WorkExperience::factory()->create();
        $applicant = Applicant::factory()->create();
        $organisation = $this->faker->word;
        $job_title = $this->faker->word;
        $start_date = $this->faker->date();
        $end_date = $this->faker->word;

        $response = $this->put(route('work-experience.update', $workExperience), [
            'applicant_id' => $applicant->id,
            'organisation' => $organisation,
            'job_title' => $job_title,
            'start_date' => $start_date,
            'end_date' => $end_date,
        ]);

        $workExperience->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($applicant->id, $workExperience->applicant_id);
        $this->assertEquals($organisation, $workExperience->organisation);
        $this->assertEquals($job_title, $workExperience->job_title);
        $this->assertEquals(Carbon::parse($start_date), $workExperience->start_date);
        $this->assertEquals($end_date, $workExperience->end_date);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $workExperience = WorkExperience::factory()->create();

        $response = $this->delete(route('work-experience.destroy', $workExperience));

        $response->assertNoContent();

        $this->assertModelMissing($workExperience);
    }
}
