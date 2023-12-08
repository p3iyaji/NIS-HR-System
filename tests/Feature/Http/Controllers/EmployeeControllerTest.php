<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Department;
use App\Models\Designation;
use App\Models\Division;
use App\Models\Employee;
use App\Models\GeoLga;
use App\Models\GeoState;
use App\Models\GradeLevel;
use App\Models\Office;
use App\Models\Step;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\EmployeeController
 */
class EmployeeControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $employees = Employee::factory()->count(3)->create();

        $response = $this->get(route('employee.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\EmployeeController::class,
            'store',
            \App\Http\Requests\EmployeeStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $first_name = $this->faker->firstName;
        $last_name = $this->faker->lastName;
        $date_of_birth = $this->faker->date();
        $gender = $this->faker->randomElement(/** enum_attributes **/);
        $nationality = $this->faker->word;
        $contact_number = $this->faker->word;
        $city = $this->faker->city;
        $geo_state = GeoState::factory()->create();
        $geo_lga = GeoLga::factory()->create();
        $grade_level = GradeLevel::factory()->create();
        $step = Step::factory()->create();
        $zip_code = $this->faker->word;
        $country = $this->faker->country;
        $hire_date = $this->faker->date();
        $job_title = $this->faker->word;
        $office = Office::factory()->create();
        $department = Department::factory()->create();
        $division = Division::factory()->create();
        $unit = Unit::factory()->create();
        $designation = Designation::factory()->create();
        $blood_group = $this->faker->word;
        $height = $this->faker->word;
        $genotype = $this->faker->word;
        $command = $this->faker->word;
        $duty_post = $this->faker->word;
        $marital_status = $this->faker->randomElement(/** enum_attributes **/);
        $next_of_kin = $this->faker->word;
        $nok_number = $this->faker->word;
        $nok_email = $this->faker->word;
        $permanent_home_address = $this->faker->word;
        $residential_address = $this->faker->word;
        $photograph = $this->faker->word;
        $service_number = $this->faker->word;
        $file_number = $this->faker->word;
        $fingerprint = $this->faker->word;
        $nin = $this->faker->word;
        $passport_number = $this->faker->word;
        $exit_date = $this->faker->date();

        $response = $this->post(route('employee.store'), [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'date_of_birth' => $date_of_birth,
            'gender' => $gender,
            'nationality' => $nationality,
            'contact_number' => $contact_number,
            'city' => $city,
            'geo_state_id' => $geo_state->id,
            'geo_lga_id' => $geo_lga->id,
            'grade_level_id' => $grade_level->id,
            'step_id' => $step->id,
            'zip_code' => $zip_code,
            'country' => $country,
            'hire_date' => $hire_date,
            'job_title' => $job_title,
            'office_id' => $office->id,
            'department_id' => $department->id,
            'division_id' => $division->id,
            'unit_id' => $unit->id,
            'designation' => $designation->id,
            'blood_group' => $blood_group,
            'height' => $height,
            'genotype' => $genotype,
            'command' => $command,
            'duty_post' => $duty_post,
            'marital_status' => $marital_status,
            'next_of_kin' => $next_of_kin,
            'nok_number' => $nok_number,
            'nok_email' => $nok_email,
            'permanent_home_address' => $permanent_home_address,
            'residential_address' => $residential_address,
            'photograph' => $photograph,
            'service_number' => $service_number,
            'file_number' => $file_number,
            'fingerprint' => $fingerprint,
            'nin' => $nin,
            'passport_number' => $passport_number,
            'exit_date' => $exit_date,
        ]);

        $employees = Employee::query()
            ->where('first_name', $first_name)
            ->where('last_name', $last_name)
            ->where('date_of_birth', $date_of_birth)
            ->where('gender', $gender)
            ->where('nationality', $nationality)
            ->where('contact_number', $contact_number)
            ->where('city', $city)
            ->where('geo_state_id', $geo_state->id)
            ->where('geo_lga_id', $geo_lga->id)
            ->where('grade_level_id', $grade_level->id)
            ->where('step_id', $step->id)
            ->where('zip_code', $zip_code)
            ->where('country', $country)
            ->where('hire_date', $hire_date)
            ->where('job_title', $job_title)
            ->where('office_id', $office->id)
            ->where('department_id', $department->id)
            ->where('division_id', $division->id)
            ->where('unit_id', $unit->id)
            ->where('designation', $designation->id)
            ->where('blood_group', $blood_group)
            ->where('height', $height)
            ->where('genotype', $genotype)
            ->where('command', $command)
            ->where('duty_post', $duty_post)
            ->where('marital_status', $marital_status)
            ->where('next_of_kin', $next_of_kin)
            ->where('nok_number', $nok_number)
            ->where('nok_email', $nok_email)
            ->where('permanent_home_address', $permanent_home_address)
            ->where('residential_address', $residential_address)
            ->where('photograph', $photograph)
            ->where('service_number', $service_number)
            ->where('file_number', $file_number)
            ->where('fingerprint', $fingerprint)
            ->where('nin', $nin)
            ->where('passport_number', $passport_number)
            ->where('exit_date', $exit_date)
            ->get();
        $this->assertCount(1, $employees);
        $employee = $employees->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $employee = Employee::factory()->create();

        $response = $this->get(route('employee.show', $employee));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\EmployeeController::class,
            'update',
            \App\Http\Requests\EmployeeUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $employee = Employee::factory()->create();
        $first_name = $this->faker->firstName;
        $last_name = $this->faker->lastName;
        $date_of_birth = $this->faker->date();
        $gender = $this->faker->randomElement(/** enum_attributes **/);
        $nationality = $this->faker->word;
        $contact_number = $this->faker->word;
        $city = $this->faker->city;
        $geo_state = GeoState::factory()->create();
        $geo_lga = GeoLga::factory()->create();
        $grade_level = GradeLevel::factory()->create();
        $step = Step::factory()->create();
        $zip_code = $this->faker->word;
        $country = $this->faker->country;
        $hire_date = $this->faker->date();
        $job_title = $this->faker->word;
        $office = Office::factory()->create();
        $department = Department::factory()->create();
        $division = Division::factory()->create();
        $unit = Unit::factory()->create();
        $designation = Designation::factory()->create();
        $blood_group = $this->faker->word;
        $height = $this->faker->word;
        $genotype = $this->faker->word;
        $command = $this->faker->word;
        $duty_post = $this->faker->word;
        $marital_status = $this->faker->randomElement(/** enum_attributes **/);
        $next_of_kin = $this->faker->word;
        $nok_number = $this->faker->word;
        $nok_email = $this->faker->word;
        $permanent_home_address = $this->faker->word;
        $residential_address = $this->faker->word;
        $photograph = $this->faker->word;
        $service_number = $this->faker->word;
        $file_number = $this->faker->word;
        $fingerprint = $this->faker->word;
        $nin = $this->faker->word;
        $passport_number = $this->faker->word;
        $exit_date = $this->faker->date();

        $response = $this->put(route('employee.update', $employee), [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'date_of_birth' => $date_of_birth,
            'gender' => $gender,
            'nationality' => $nationality,
            'contact_number' => $contact_number,
            'city' => $city,
            'geo_state_id' => $geo_state->id,
            'geo_lga_id' => $geo_lga->id,
            'grade_level_id' => $grade_level->id,
            'step_id' => $step->id,
            'zip_code' => $zip_code,
            'country' => $country,
            'hire_date' => $hire_date,
            'job_title' => $job_title,
            'office_id' => $office->id,
            'department_id' => $department->id,
            'division_id' => $division->id,
            'unit_id' => $unit->id,
            'designation' => $designation->id,
            'blood_group' => $blood_group,
            'height' => $height,
            'genotype' => $genotype,
            'command' => $command,
            'duty_post' => $duty_post,
            'marital_status' => $marital_status,
            'next_of_kin' => $next_of_kin,
            'nok_number' => $nok_number,
            'nok_email' => $nok_email,
            'permanent_home_address' => $permanent_home_address,
            'residential_address' => $residential_address,
            'photograph' => $photograph,
            'service_number' => $service_number,
            'file_number' => $file_number,
            'fingerprint' => $fingerprint,
            'nin' => $nin,
            'passport_number' => $passport_number,
            'exit_date' => $exit_date,
        ]);

        $employee->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($first_name, $employee->first_name);
        $this->assertEquals($last_name, $employee->last_name);
        $this->assertEquals(Carbon::parse($date_of_birth), $employee->date_of_birth);
        $this->assertEquals($gender, $employee->gender);
        $this->assertEquals($nationality, $employee->nationality);
        $this->assertEquals($contact_number, $employee->contact_number);
        $this->assertEquals($city, $employee->city);
        $this->assertEquals($geo_state->id, $employee->geo_state_id);
        $this->assertEquals($geo_lga->id, $employee->geo_lga_id);
        $this->assertEquals($grade_level->id, $employee->grade_level_id);
        $this->assertEquals($step->id, $employee->step_id);
        $this->assertEquals($zip_code, $employee->zip_code);
        $this->assertEquals($country, $employee->country);
        $this->assertEquals(Carbon::parse($hire_date), $employee->hire_date);
        $this->assertEquals($job_title, $employee->job_title);
        $this->assertEquals($office->id, $employee->office_id);
        $this->assertEquals($department->id, $employee->department_id);
        $this->assertEquals($division->id, $employee->division_id);
        $this->assertEquals($unit->id, $employee->unit_id);
        $this->assertEquals($designation->id, $employee->designation);
        $this->assertEquals($blood_group, $employee->blood_group);
        $this->assertEquals($height, $employee->height);
        $this->assertEquals($genotype, $employee->genotype);
        $this->assertEquals($command, $employee->command);
        $this->assertEquals($duty_post, $employee->duty_post);
        $this->assertEquals($marital_status, $employee->marital_status);
        $this->assertEquals($next_of_kin, $employee->next_of_kin);
        $this->assertEquals($nok_number, $employee->nok_number);
        $this->assertEquals($nok_email, $employee->nok_email);
        $this->assertEquals($permanent_home_address, $employee->permanent_home_address);
        $this->assertEquals($residential_address, $employee->residential_address);
        $this->assertEquals($photograph, $employee->photograph);
        $this->assertEquals($service_number, $employee->service_number);
        $this->assertEquals($file_number, $employee->file_number);
        $this->assertEquals($fingerprint, $employee->fingerprint);
        $this->assertEquals($nin, $employee->nin);
        $this->assertEquals($passport_number, $employee->passport_number);
        $this->assertEquals(Carbon::parse($exit_date), $employee->exit_date);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $employee = Employee::factory()->create();

        $response = $this->delete(route('employee.destroy', $employee));

        $response->assertNoContent();

        $this->assertModelMissing($employee);
    }
}
