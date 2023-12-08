<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Applicant;
use App\Models\GeoLga;
use App\Models\GeoState;
use App\Models\JobPosition;
use App\Models\User;

class ApplicantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Applicant::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'date_of_birth' => $this->faker->date(),
            'nin' => $this->faker->word,
            'gender' => $this->faker->randomElement(["Male","Female"]),
            'address' => $this->faker->word,
            'city' => $this->faker->city,
            'geo_state_id' => GeoState::factory(),
            'geo_lga_id' => GeoLga::factory(),
            'zip_postal_code' => $this->faker->word,
            'email_address' => $this->faker->word,
            'phone_number' => $this->faker->phoneNumber,
            'user_id' => User::factory(),
            'job_position_id' => JobPosition::factory(),
        ];
    }
}
