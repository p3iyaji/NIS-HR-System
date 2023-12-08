<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Applicant;
use App\Models\Qualification;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\QualificationController
 */
class QualificationControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $qualifications = Qualification::factory()->count(3)->create();

        $response = $this->get(route('qualification.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\QualificationController::class,
            'store',
            \App\Http\Requests\QualificationStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $applicant = Applicant::factory()->create();
        $institution = $this->faker->word;
        $certificate_obtained = $this->faker->word;
        $start_date = $this->faker->date();
        $end_date = $this->faker->word;

        $response = $this->post(route('qualification.store'), [
            'applicant_id' => $applicant->id,
            'institution' => $institution,
            'certificate_obtained' => $certificate_obtained,
            'start_date' => $start_date,
            'end_date' => $end_date,
        ]);

        $qualifications = Qualification::query()
            ->where('applicant_id', $applicant->id)
            ->where('institution', $institution)
            ->where('certificate_obtained', $certificate_obtained)
            ->where('start_date', $start_date)
            ->where('end_date', $end_date)
            ->get();
        $this->assertCount(1, $qualifications);
        $qualification = $qualifications->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $qualification = Qualification::factory()->create();

        $response = $this->get(route('qualification.show', $qualification));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\QualificationController::class,
            'update',
            \App\Http\Requests\QualificationUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $qualification = Qualification::factory()->create();
        $applicant = Applicant::factory()->create();
        $institution = $this->faker->word;
        $certificate_obtained = $this->faker->word;
        $start_date = $this->faker->date();
        $end_date = $this->faker->word;

        $response = $this->put(route('qualification.update', $qualification), [
            'applicant_id' => $applicant->id,
            'institution' => $institution,
            'certificate_obtained' => $certificate_obtained,
            'start_date' => $start_date,
            'end_date' => $end_date,
        ]);

        $qualification->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($applicant->id, $qualification->applicant_id);
        $this->assertEquals($institution, $qualification->institution);
        $this->assertEquals($certificate_obtained, $qualification->certificate_obtained);
        $this->assertEquals(Carbon::parse($start_date), $qualification->start_date);
        $this->assertEquals($end_date, $qualification->end_date);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $qualification = Qualification::factory()->create();

        $response = $this->delete(route('qualification.destroy', $qualification));

        $response->assertNoContent();

        $this->assertModelMissing($qualification);
    }
}
