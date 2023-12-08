<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Applicant;
use App\Models\JobApplication;
use App\Models\JobPosition;

class JobApplicationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JobApplication::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'applicant_id' => Applicant::factory(),
            'job_position_id' => JobPosition::factory(),
            'application_date' => $this->faker->date(),
            'status' => $this->faker->randomElement(["pending","in-review","accepted","rejected"]),
            'screening_date' => $this->faker->date(),
            'comment_note' => $this->faker->text,
        ];
    }
}
