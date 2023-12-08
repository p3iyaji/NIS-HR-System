<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\CreatedBy;
use App\Models\Deployment;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\DeploymentController
 */
class DeploymentControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $deployments = Deployment::factory()->count(3)->create();

        $response = $this->get(route('deployment.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\DeploymentController::class,
            'store',
            \App\Http\Requests\DeploymentStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $employee = Employee::factory()->create();
        $current_location = $this->faker->word;
        $location_of_deployment = $this->faker->word;
        $date_of_deployment = $this->faker->date();
        $reason_for_deployment = $this->faker->word;
        $created_by = CreatedBy::factory()->create();

        $response = $this->post(route('deployment.store'), [
            'employee_id' => $employee->id,
            'current_location' => $current_location,
            'location_of_deployment' => $location_of_deployment,
            'date_of_deployment' => $date_of_deployment,
            'reason_for_deployment' => $reason_for_deployment,
            'created_by' => $created_by->id,
        ]);

        $deployments = Deployment::query()
            ->where('employee_id', $employee->id)
            ->where('current_location', $current_location)
            ->where('location_of_deployment', $location_of_deployment)
            ->where('date_of_deployment', $date_of_deployment)
            ->where('reason_for_deployment', $reason_for_deployment)
            ->where('created_by', $created_by->id)
            ->get();
        $this->assertCount(1, $deployments);
        $deployment = $deployments->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $deployment = Deployment::factory()->create();

        $response = $this->get(route('deployment.show', $deployment));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\DeploymentController::class,
            'update',
            \App\Http\Requests\DeploymentUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $deployment = Deployment::factory()->create();
        $employee = Employee::factory()->create();
        $current_location = $this->faker->word;
        $location_of_deployment = $this->faker->word;
        $date_of_deployment = $this->faker->date();
        $reason_for_deployment = $this->faker->word;
        $created_by = CreatedBy::factory()->create();

        $response = $this->put(route('deployment.update', $deployment), [
            'employee_id' => $employee->id,
            'current_location' => $current_location,
            'location_of_deployment' => $location_of_deployment,
            'date_of_deployment' => $date_of_deployment,
            'reason_for_deployment' => $reason_for_deployment,
            'created_by' => $created_by->id,
        ]);

        $deployment->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($employee->id, $deployment->employee_id);
        $this->assertEquals($current_location, $deployment->current_location);
        $this->assertEquals($location_of_deployment, $deployment->location_of_deployment);
        $this->assertEquals(Carbon::parse($date_of_deployment), $deployment->date_of_deployment);
        $this->assertEquals($reason_for_deployment, $deployment->reason_for_deployment);
        $this->assertEquals($created_by->id, $deployment->created_by);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $deployment = Deployment::factory()->create();

        $response = $this->delete(route('deployment.destroy', $deployment));

        $response->assertNoContent();

        $this->assertModelMissing($deployment);
    }
}
