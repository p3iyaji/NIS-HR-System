<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\EmpCertification;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\EmpCertificationController
 */
class EmpCertificationControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $empCertifications = EmpCertification::factory()->count(3)->create();

        $response = $this->get(route('emp-certification.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\EmpCertificationController::class,
            'store',
            \App\Http\Requests\EmpCertificationStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $employee = Employee::factory()->create();
        $certification_name = $this->faker->word;
        $issuing_authority = $this->faker->word;
        $date_obtained = $this->faker->date();

        $response = $this->post(route('emp-certification.store'), [
            'employee_id' => $employee->id,
            'certification_name' => $certification_name,
            'issuing_authority' => $issuing_authority,
            'date_obtained' => $date_obtained,
        ]);

        $empCertifications = EmpCertification::query()
            ->where('employee_id', $employee->id)
            ->where('certification_name', $certification_name)
            ->where('issuing_authority', $issuing_authority)
            ->where('date_obtained', $date_obtained)
            ->get();
        $this->assertCount(1, $empCertifications);
        $empCertification = $empCertifications->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $empCertification = EmpCertification::factory()->create();

        $response = $this->get(route('emp-certification.show', $empCertification));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\EmpCertificationController::class,
            'update',
            \App\Http\Requests\EmpCertificationUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $empCertification = EmpCertification::factory()->create();
        $employee = Employee::factory()->create();
        $certification_name = $this->faker->word;
        $issuing_authority = $this->faker->word;
        $date_obtained = $this->faker->date();

        $response = $this->put(route('emp-certification.update', $empCertification), [
            'employee_id' => $employee->id,
            'certification_name' => $certification_name,
            'issuing_authority' => $issuing_authority,
            'date_obtained' => $date_obtained,
        ]);

        $empCertification->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($employee->id, $empCertification->employee_id);
        $this->assertEquals($certification_name, $empCertification->certification_name);
        $this->assertEquals($issuing_authority, $empCertification->issuing_authority);
        $this->assertEquals(Carbon::parse($date_obtained), $empCertification->date_obtained);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $empCertification = EmpCertification::factory()->create();

        $response = $this->delete(route('emp-certification.destroy', $empCertification));

        $response->assertNoContent();

        $this->assertModelMissing($empCertification);
    }
}
