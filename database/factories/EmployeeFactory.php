<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
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

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'date_of_birth' => $this->faker->date(),
            'gender' => $this->faker->randomElement(["Male","Female"]),
            'nationality' => $this->faker->word,
            'contact_number' => $this->faker->word,
            'city' => $this->faker->city,
            'geo_state_id' => GeoState::factory(),
            'geo_lga_id' => GeoLga::factory(),
            'grade_level_id' => GradeLevel::factory(),
            'step_id' => Step::factory(),
            'zip_code' => $this->faker->word,
            'country' => $this->faker->country,
            'hire_date' => $this->faker->date(),
            'job_title' => $this->faker->word,
            'office_id' => Office::factory(),
            'department_id' => Department::factory(),
            'division_id' => Division::factory(),
            'unit_id' => Unit::factory(),
            'designation' => Designation::factory(),
            'blood_group' => $this->faker->word,
            'height' => $this->faker->word,
            'genotype' => $this->faker->word,
            'command' => $this->faker->word,
            'duty_post' => $this->faker->word,
            'marital_status' => $this->faker->randomElement(["Single","Married","Divorced","Widowed"]),
            'next_of_kin' => $this->faker->word,
            'nok_number' => $this->faker->word,
            'nok_email' => $this->faker->word,
            'permanent_home_address' => $this->faker->word,
            'residential_address' => $this->faker->word,
            'photograph' => $this->faker->word,
            'service_number' => $this->faker->word,
            'file_number' => $this->faker->word,
            'fingerprint' => $this->faker->word,
            'nin' => $this->faker->word,
            'passport_number' => $this->faker->word,
            'exit_date' => $this->faker->date(),
        ];
    }
}
