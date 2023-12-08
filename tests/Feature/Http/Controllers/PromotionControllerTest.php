<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Employee;
use App\Models\Promotion;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PromotionController
 */
class PromotionControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $promotions = Promotion::factory()->count(3)->create();

        $response = $this->get(route('promotion.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PromotionController::class,
            'store',
            \App\Http\Requests\PromotionStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $employee = Employee::factory()->create();
        $old_job_title = $this->faker->word;
        $new_job_title = $this->faker->word;
        $promotion_date = $this->faker->date();
        $next_promotion_due_date = $this->faker->date();
        $created_by = $this->faker->word;

        $response = $this->post(route('promotion.store'), [
            'employee_id' => $employee->id,
            'old_job_title' => $old_job_title,
            'new_job_title' => $new_job_title,
            'promotion_date' => $promotion_date,
            'next_promotion_due_date' => $next_promotion_due_date,
            'created_by' => $created_by,
        ]);

        $promotions = Promotion::query()
            ->where('employee_id', $employee->id)
            ->where('old_job_title', $old_job_title)
            ->where('new_job_title', $new_job_title)
            ->where('promotion_date', $promotion_date)
            ->where('next_promotion_due_date', $next_promotion_due_date)
            ->where('created_by', $created_by)
            ->get();
        $this->assertCount(1, $promotions);
        $promotion = $promotions->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $promotion = Promotion::factory()->create();

        $response = $this->get(route('promotion.show', $promotion));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PromotionController::class,
            'update',
            \App\Http\Requests\PromotionUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $promotion = Promotion::factory()->create();
        $employee = Employee::factory()->create();
        $old_job_title = $this->faker->word;
        $new_job_title = $this->faker->word;
        $promotion_date = $this->faker->date();
        $next_promotion_due_date = $this->faker->date();
        $created_by = $this->faker->word;

        $response = $this->put(route('promotion.update', $promotion), [
            'employee_id' => $employee->id,
            'old_job_title' => $old_job_title,
            'new_job_title' => $new_job_title,
            'promotion_date' => $promotion_date,
            'next_promotion_due_date' => $next_promotion_due_date,
            'created_by' => $created_by,
        ]);

        $promotion->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($employee->id, $promotion->employee_id);
        $this->assertEquals($old_job_title, $promotion->old_job_title);
        $this->assertEquals($new_job_title, $promotion->new_job_title);
        $this->assertEquals(Carbon::parse($promotion_date), $promotion->promotion_date);
        $this->assertEquals(Carbon::parse($next_promotion_due_date), $promotion->next_promotion_due_date);
        $this->assertEquals($created_by, $promotion->created_by);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $promotion = Promotion::factory()->create();

        $response = $this->delete(route('promotion.destroy', $promotion));

        $response->assertNoContent();

        $this->assertModelMissing($promotion);
    }
}
