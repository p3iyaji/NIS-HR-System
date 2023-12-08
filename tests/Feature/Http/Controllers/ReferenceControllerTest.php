<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Applicant;
use App\Models\Reference;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ReferenceController
 */
class ReferenceControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $references = Reference::factory()->count(3)->create();

        $response = $this->get(route('reference.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ReferenceController::class,
            'store',
            \App\Http\Requests\ReferenceStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $applicant = Applicant::factory()->create();
        $referrer_name = $this->faker->word;
        $referrer_email = $this->faker->word;
        $referrer_mobile = $this->faker->word;
        $relationship_applicant = $this->faker->word;

        $response = $this->post(route('reference.store'), [
            'applicant_id' => $applicant->id,
            'referrer_name' => $referrer_name,
            'referrer_email' => $referrer_email,
            'referrer_mobile' => $referrer_mobile,
            'relationship_applicant' => $relationship_applicant,
        ]);

        $references = Reference::query()
            ->where('applicant_id', $applicant->id)
            ->where('referrer_name', $referrer_name)
            ->where('referrer_email', $referrer_email)
            ->where('referrer_mobile', $referrer_mobile)
            ->where('relationship_applicant', $relationship_applicant)
            ->get();
        $this->assertCount(1, $references);
        $reference = $references->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $reference = Reference::factory()->create();

        $response = $this->get(route('reference.show', $reference));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ReferenceController::class,
            'update',
            \App\Http\Requests\ReferenceUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $reference = Reference::factory()->create();
        $applicant = Applicant::factory()->create();
        $referrer_name = $this->faker->word;
        $referrer_email = $this->faker->word;
        $referrer_mobile = $this->faker->word;
        $relationship_applicant = $this->faker->word;

        $response = $this->put(route('reference.update', $reference), [
            'applicant_id' => $applicant->id,
            'referrer_name' => $referrer_name,
            'referrer_email' => $referrer_email,
            'referrer_mobile' => $referrer_mobile,
            'relationship_applicant' => $relationship_applicant,
        ]);

        $reference->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($applicant->id, $reference->applicant_id);
        $this->assertEquals($referrer_name, $reference->referrer_name);
        $this->assertEquals($referrer_email, $reference->referrer_email);
        $this->assertEquals($referrer_mobile, $reference->referrer_mobile);
        $this->assertEquals($relationship_applicant, $reference->relationship_applicant);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $reference = Reference::factory()->create();

        $response = $this->delete(route('reference.destroy', $reference));

        $response->assertNoContent();

        $this->assertModelMissing($reference);
    }
}
