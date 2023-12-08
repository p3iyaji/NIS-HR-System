<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\LeaveType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\LeaveTypeController
 */
class LeaveTypeControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $leaveTypes = LeaveType::factory()->count(3)->create();

        $response = $this->get(route('leave-type.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\LeaveTypeController::class,
            'store',
            \App\Http\Requests\LeaveTypeStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $leave_type_name = $this->faker->word;
        $description = $this->faker->text;

        $response = $this->post(route('leave-type.store'), [
            'leave_type_name' => $leave_type_name,
            'description' => $description,
        ]);

        $leaveTypes = LeaveType::query()
            ->where('leave_type_name', $leave_type_name)
            ->where('description', $description)
            ->get();
        $this->assertCount(1, $leaveTypes);
        $leaveType = $leaveTypes->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $leaveType = LeaveType::factory()->create();

        $response = $this->get(route('leave-type.show', $leaveType));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\LeaveTypeController::class,
            'update',
            \App\Http\Requests\LeaveTypeUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $leaveType = LeaveType::factory()->create();
        $leave_type_name = $this->faker->word;
        $description = $this->faker->text;

        $response = $this->put(route('leave-type.update', $leaveType), [
            'leave_type_name' => $leave_type_name,
            'description' => $description,
        ]);

        $leaveType->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($leave_type_name, $leaveType->leave_type_name);
        $this->assertEquals($description, $leaveType->description);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $leaveType = LeaveType::factory()->create();

        $response = $this->delete(route('leave-type.destroy', $leaveType));

        $response->assertNoContent();

        $this->assertModelMissing($leaveType);
    }
}
