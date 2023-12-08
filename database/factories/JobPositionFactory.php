<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\JobPosition;

class JobPositionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JobPosition::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'position_name' => $this->faker->word,
            'department' => $this->faker->word,
            'job_description' => $this->faker->word,
            'required_qualifications' => $this->faker->text,
            'applicant_deadline' => $this->faker->word,
            'status' => $this->faker->randomElement(["open","close"]),
            'deleted_at' => $this->faker->dateTime(),
        ];
    }
}
