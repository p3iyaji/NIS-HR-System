<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Applicant;
use App\Models\JobPosition;
use App\Models\ShortlistedApplicant;

class ShortlistedApplicantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ShortlistedApplicant::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'job_position_id' => JobPosition::factory(),
            'applicant_id' => Applicant::factory(),
            'interview_date' => $this->faker->dateTime(),
            'status' => $this->faker->randomElement(["pending-interview","interviewed","accepted","rejected"]),
        ];
    }
}
