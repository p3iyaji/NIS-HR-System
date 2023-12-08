<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\EmpQualification;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\EmpQualificationController
 */
class EmpQualificationControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $empQualifications = EmpQualification::factory()->count(3)->create();

        $response = $this->get(route('emp-qualification.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\EmpQualificationController::class,
            'store',
            \App\Http\Requests\EmpQualificationStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $employee = Employee::factory()->create();
        $institution = $this->faker->word;
        $certificate_obtained = $this->faker->word;
        $start_date = $this->faker->date();
        $end_date = $this->faker->word;

        $response = $this->post(route('emp-qualification.store'), [
            'employee_id' => $employee->id,
            'institution' => $institution,
            'certificate_obtained' => $certificate_obtained,
            'start_date' => $start_date,
            'end_date' => $end_date,
        ]);

        $empQualifications = EmpQualification::query()
            ->where('employee_id', $employee->id)
            ->where('institution', $institution)
            ->where('certificate_obtained', $certificate_obtained)
            ->where('start_date', $start_date)
            ->where('end_date', $end_date)
            ->get();
        $this->assertCount(1, $empQualifications);
        $empQualification = $empQualifications->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $empQualification = EmpQualification::factory()->create();

        $response = $this->get(route('emp-qualification.show', $empQualification));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\EmpQualificationController::class,
            'update',
            \App\Http\Requests\EmpQualificationUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $empQualification = EmpQualification::factory()->create();
        $employee = Employee::factory()->create();
        $institution = $this->faker->word;
        $certificate_obtained = $this->faker->word;
        $start_date = $this->faker->date();
        $end_date = $this->faker->word;

        $response = $this->put(route('emp-qualification.update', $empQualification), [
            'employee_id' => $employee->id,
            'institution' => $institution,
            'certificate_obtained' => $certificate_obtained,
            'start_date' => $start_date,
            'end_date' => $end_date,
        ]);

        $empQualification->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($employee->id, $empQualification->employee_id);
        $this->assertEquals($institution, $empQualification->institution);
        $this->assertEquals($certificate_obtained, $empQualification->certificate_obtained);
        $this->assertEquals(Carbon::parse($start_date), $empQualification->start_date);
        $this->assertEquals($end_date, $empQualification->end_date);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $empQualification = EmpQualification::factory()->create();

        $response = $this->delete(route('emp-qualification.destroy', $empQualification));

        $response->assertNoContent();

        $this->assertModelMissing($empQualification);
    }
}
