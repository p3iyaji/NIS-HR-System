<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Applicant;
use App\Models\Certification;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\CertificationController
 */
class CertificationControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $certifications = Certification::factory()->count(3)->create();

        $response = $this->get(route('certification.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CertificationController::class,
            'store',
            \App\Http\Requests\CertificationStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $applicant = Applicant::factory()->create();
        $certification_name = $this->faker->word;
        $issuing_authority = $this->faker->word;
        $date_obtained = $this->faker->date();

        $response = $this->post(route('certification.store'), [
            'applicant_id' => $applicant->id,
            'certification_name' => $certification_name,
            'issuing_authority' => $issuing_authority,
            'date_obtained' => $date_obtained,
        ]);

        $certifications = Certification::query()
            ->where('applicant_id', $applicant->id)
            ->where('certification_name', $certification_name)
            ->where('issuing_authority', $issuing_authority)
            ->where('date_obtained', $date_obtained)
            ->get();
        $this->assertCount(1, $certifications);
        $certification = $certifications->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $certification = Certification::factory()->create();

        $response = $this->get(route('certification.show', $certification));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CertificationController::class,
            'update',
            \App\Http\Requests\CertificationUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $certification = Certification::factory()->create();
        $applicant = Applicant::factory()->create();
        $certification_name = $this->faker->word;
        $issuing_authority = $this->faker->word;
        $date_obtained = $this->faker->date();

        $response = $this->put(route('certification.update', $certification), [
            'applicant_id' => $applicant->id,
            'certification_name' => $certification_name,
            'issuing_authority' => $issuing_authority,
            'date_obtained' => $date_obtained,
        ]);

        $certification->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($applicant->id, $certification->applicant_id);
        $this->assertEquals($certification_name, $certification->certification_name);
        $this->assertEquals($issuing_authority, $certification->issuing_authority);
        $this->assertEquals(Carbon::parse($date_obtained), $certification->date_obtained);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $certification = Certification::factory()->create();

        $response = $this->delete(route('certification.destroy', $certification));

        $response->assertNoContent();

        $this->assertModelMissing($certification);
    }
}
