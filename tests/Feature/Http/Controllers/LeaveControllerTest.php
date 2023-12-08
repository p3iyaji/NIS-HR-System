<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\ApprovedBy;
use App\Models\CreatedBy;
use App\Models\Employee;
use App\Models\Leave;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\LeaveController
 */
class LeaveControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $leaves = Leave::factory()->count(3)->create();

        $response = $this->get(route('leave.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\LeaveController::class,
            'store',
            \App\Http\Requests\LeaveStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $employee = Employee::factory()->create();
        $Leave_type = $this->faker->word;
        $Leave_days = $this->faker->word;
        $Leave_date_from = $this->faker->date();
        $Leave_date_to = $this->faker->date();
        $leave_reason = $this->faker->word;
        $status = $this->faker->randomElement(/** enum_attributes **/);
        $created_by = CreatedBy::factory()->create();
        $approved_by = ApprovedBy::factory()->create();
        $approved_at = $this->faker->dateTime();

        $response = $this->post(route('leave.store'), [
            'employee_id' => $employee->id,
            'Leave_type' => $Leave_type,
            'Leave_days' => $Leave_days,
            'Leave_date_from' => $Leave_date_from,
            'Leave_date_to' => $Leave_date_to,
            'leave_reason' => $leave_reason,
            'status' => $status,
            'created_by' => $created_by->id,
            'approved_by' => $approved_by->id,
            'approved_at' => $approved_at,
        ]);

        $leaves = Leave::query()
            ->where('employee_id', $employee->id)
            ->where('Leave_type', $Leave_type)
            ->where('Leave_days', $Leave_days)
            ->where('Leave_date_from', $Leave_date_from)
            ->where('Leave_date_to', $Leave_date_to)
            ->where('leave_reason', $leave_reason)
            ->where('status', $status)
            ->where('created_by', $created_by->id)
            ->where('approved_by', $approved_by->id)
            ->where('approved_at', $approved_at)
            ->get();
        $this->assertCount(1, $leaves);
        $leave = $leaves->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $leave = Leave::factory()->create();

        $response = $this->get(route('leave.show', $leave));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\LeaveController::class,
            'update',
            \App\Http\Requests\LeaveUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $leave = Leave::factory()->create();
        $employee = Employee::factory()->create();
        $Leave_type = $this->faker->word;
        $Leave_days = $this->faker->word;
        $Leave_date_from = $this->faker->date();
        $Leave_date_to = $this->faker->date();
        $leave_reason = $this->faker->word;
        $status = $this->faker->randomElement(/** enum_attributes **/);
        $created_by = CreatedBy::factory()->create();
        $approved_by = ApprovedBy::factory()->create();
        $approved_at = $this->faker->dateTime();

        $response = $this->put(route('leave.update', $leave), [
            'employee_id' => $employee->id,
            'Leave_type' => $Leave_type,
            'Leave_days' => $Leave_days,
            'Leave_date_from' => $Leave_date_from,
            'Leave_date_to' => $Leave_date_to,
            'leave_reason' => $leave_reason,
            'status' => $status,
            'created_by' => $created_by->id,
            'approved_by' => $approved_by->id,
            'approved_at' => $approved_at,
        ]);

        $leave->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($employee->id, $leave->employee_id);
        $this->assertEquals($Leave_type, $leave->Leave_type);
        $this->assertEquals($Leave_days, $leave->Leave_days);
        $this->assertEquals(Carbon::parse($Leave_date_from), $leave->Leave_date_from);
        $this->assertEquals(Carbon::parse($Leave_date_to), $leave->Leave_date_to);
        $this->assertEquals($leave_reason, $leave->leave_reason);
        $this->assertEquals($status, $leave->status);
        $this->assertEquals($created_by->id, $leave->created_by);
        $this->assertEquals($approved_by->id, $leave->approved_by);
        $this->assertEquals($approved_at, $leave->approved_at);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $leave = Leave::factory()->create();

        $response = $this->delete(route('leave.destroy', $leave));

        $response->assertNoContent();

        $this->assertModelMissing($leave);
    }
}
