<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Applicant;
use App\Models\GeoLga;
use App\Models\GeoState;
use App\Models\JobPosition;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ApplicantController
 */
class ApplicantControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $applicants = Applicant::factory()->count(3)->create();

        $response = $this->get(route('applicant.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ApplicantController::class,
            'store',
            \App\Http\Requests\ApplicantStoreRequest::class
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
        $nin = $this->faker->word;
        $gender = $this->faker->randomElement(/** enum_attributes **/);
        $address = $this->faker->word;
        $city = $this->faker->city;
        $geo_state = GeoState::factory()->create();
        $geo_lga = GeoLga::factory()->create();
        $zip_postal_code = $this->faker->word;
        $email_address = $this->faker->word;
        $phone_number = $this->faker->phoneNumber;
        $user = User::factory()->create();
        $job_position = JobPosition::factory()->create();

        $response = $this->post(route('applicant.store'), [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'date_of_birth' => $date_of_birth,
            'nin' => $nin,
            'gender' => $gender,
            'address' => $address,
            'city' => $city,
            'geo_state_id' => $geo_state->id,
            'geo_lga_id' => $geo_lga->id,
            'zip_postal_code' => $zip_postal_code,
            'email_address' => $email_address,
            'phone_number' => $phone_number,
            'user_id' => $user->id,
            'job_position_id' => $job_position->id,
        ]);

        $applicants = Applicant::query()
            ->where('first_name', $first_name)
            ->where('last_name', $last_name)
            ->where('date_of_birth', $date_of_birth)
            ->where('nin', $nin)
            ->where('gender', $gender)
            ->where('address', $address)
            ->where('city', $city)
            ->where('geo_state_id', $geo_state->id)
            ->where('geo_lga_id', $geo_lga->id)
            ->where('zip_postal_code', $zip_postal_code)
            ->where('email_address', $email_address)
            ->where('phone_number', $phone_number)
            ->where('user_id', $user->id)
            ->where('job_position_id', $job_position->id)
            ->get();
        $this->assertCount(1, $applicants);
        $applicant = $applicants->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $applicant = Applicant::factory()->create();

        $response = $this->get(route('applicant.show', $applicant));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ApplicantController::class,
            'update',
            \App\Http\Requests\ApplicantUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $applicant = Applicant::factory()->create();
        $first_name = $this->faker->firstName;
        $last_name = $this->faker->lastName;
        $date_of_birth = $this->faker->date();
        $nin = $this->faker->word;
        $gender = $this->faker->randomElement(/** enum_attributes **/);
        $address = $this->faker->word;
        $city = $this->faker->city;
        $geo_state = GeoState::factory()->create();
        $geo_lga = GeoLga::factory()->create();
        $zip_postal_code = $this->faker->word;
        $email_address = $this->faker->word;
        $phone_number = $this->faker->phoneNumber;
        $user = User::factory()->create();
        $job_position = JobPosition::factory()->create();

        $response = $this->put(route('applicant.update', $applicant), [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'date_of_birth' => $date_of_birth,
            'nin' => $nin,
            'gender' => $gender,
            'address' => $address,
            'city' => $city,
            'geo_state_id' => $geo_state->id,
            'geo_lga_id' => $geo_lga->id,
            'zip_postal_code' => $zip_postal_code,
            'email_address' => $email_address,
            'phone_number' => $phone_number,
            'user_id' => $user->id,
            'job_position_id' => $job_position->id,
        ]);

        $applicant->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($first_name, $applicant->first_name);
        $this->assertEquals($last_name, $applicant->last_name);
        $this->assertEquals(Carbon::parse($date_of_birth), $applicant->date_of_birth);
        $this->assertEquals($nin, $applicant->nin);
        $this->assertEquals($gender, $applicant->gender);
        $this->assertEquals($address, $applicant->address);
        $this->assertEquals($city, $applicant->city);
        $this->assertEquals($geo_state->id, $applicant->geo_state_id);
        $this->assertEquals($geo_lga->id, $applicant->geo_lga_id);
        $this->assertEquals($zip_postal_code, $applicant->zip_postal_code);
        $this->assertEquals($email_address, $applicant->email_address);
        $this->assertEquals($phone_number, $applicant->phone_number);
        $this->assertEquals($user->id, $applicant->user_id);
        $this->assertEquals($job_position->id, $applicant->job_position_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $applicant = Applicant::factory()->create();

        $response = $this->delete(route('applicant.destroy', $applicant));

        $response->assertNoContent();

        $this->assertModelMissing($applicant);
    }
}
