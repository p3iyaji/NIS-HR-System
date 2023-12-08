<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\CreatedBy;
use App\Models\Employee;
use App\Models\Transfer;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\TransferController
 */
class TransferControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $transfers = Transfer::factory()->count(3)->create();

        $response = $this->get(route('transfer.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TransferController::class,
            'store',
            \App\Http\Requests\TransferStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $employee = Employee::factory()->create();
        $current_location = $this->faker->word;
        $location_of_tranfer = $this->faker->word;
        $date_of_transfer = $this->faker->date();
        $reason_for_transfer = $this->faker->word;
        $created_by = CreatedBy::factory()->create();

        $response = $this->post(route('transfer.store'), [
            'employee_id' => $employee->id,
            'current_location' => $current_location,
            'location_of_tranfer' => $location_of_tranfer,
            'date_of_transfer' => $date_of_transfer,
            'reason_for_transfer' => $reason_for_transfer,
            'created_by' => $created_by->id,
        ]);

        $transfers = Transfer::query()
            ->where('employee_id', $employee->id)
            ->where('current_location', $current_location)
            ->where('location_of_tranfer', $location_of_tranfer)
            ->where('date_of_transfer', $date_of_transfer)
            ->where('reason_for_transfer', $reason_for_transfer)
            ->where('created_by', $created_by->id)
            ->get();
        $this->assertCount(1, $transfers);
        $transfer = $transfers->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $transfer = Transfer::factory()->create();

        $response = $this->get(route('transfer.show', $transfer));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TransferController::class,
            'update',
            \App\Http\Requests\TransferUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $transfer = Transfer::factory()->create();
        $employee = Employee::factory()->create();
        $current_location = $this->faker->word;
        $location_of_tranfer = $this->faker->word;
        $date_of_transfer = $this->faker->date();
        $reason_for_transfer = $this->faker->word;
        $created_by = CreatedBy::factory()->create();

        $response = $this->put(route('transfer.update', $transfer), [
            'employee_id' => $employee->id,
            'current_location' => $current_location,
            'location_of_tranfer' => $location_of_tranfer,
            'date_of_transfer' => $date_of_transfer,
            'reason_for_transfer' => $reason_for_transfer,
            'created_by' => $created_by->id,
        ]);

        $transfer->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($employee->id, $transfer->employee_id);
        $this->assertEquals($current_location, $transfer->current_location);
        $this->assertEquals($location_of_tranfer, $transfer->location_of_tranfer);
        $this->assertEquals(Carbon::parse($date_of_transfer), $transfer->date_of_transfer);
        $this->assertEquals($reason_for_transfer, $transfer->reason_for_transfer);
        $this->assertEquals($created_by->id, $transfer->created_by);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $transfer = Transfer::factory()->create();

        $response = $this->delete(route('transfer.destroy', $transfer));

        $response->assertNoContent();

        $this->assertModelMissing($transfer);
    }
}
