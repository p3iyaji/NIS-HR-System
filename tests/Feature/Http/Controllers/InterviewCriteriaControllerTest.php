<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\InterviewCriteria;
use App\Models\InterviewCriteria;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\InterviewCriteriaController
 */
class InterviewCriteriaControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $interviewCriteria = InterviewCriteria::factory()->count(3)->create();

        $response = $this->get(route('interview-criterion.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\InterviewCriteriaController::class,
            'store',
            \App\Http\Requests\InterviewCriteriaStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $criteria = $this->faker->word;

        $response = $this->post(route('interview-criterion.store'), [
            'criteria' => $criteria,
        ]);

        $interviewCriteria = InterviewCriteria::query()
            ->where('criteria', $criteria)
            ->get();
        $this->assertCount(1, $interviewCriteria);
        $InterviewCriteria = $interviewCriteria->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $InterviewCriteria = InterviewCriteria::factory()->create();

        $response = $this->get(route('interview-criterion.show', $InterviewCriteria));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\InterviewCriteriaController::class,
            'update',
            \App\Http\Requests\InterviewCriteriaUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $InterviewCriteria = InterviewCriteria::factory()->create();
        $criteria = $this->faker->word;

        $response = $this->put(route('interview-criterion.update', $InterviewCriteria), [
            'criteria' => $criteria,
        ]);

        $InterviewCriteria->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($criteria, $InterviewCriteria->criteria);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $InterviewCriteria = InterviewCriteria::factory()->create();
        $InterviewCriteria = InterviewCriteria::factory()->create();

        $response = $this->delete(route('interview-criterion.destroy', $InterviewCriteria));

        $response->assertNoContent();

        $this->assertModelMissing($InterviewCriteria);
    }
}
