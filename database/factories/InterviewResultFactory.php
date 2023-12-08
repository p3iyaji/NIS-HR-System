<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Applicant;
use App\Models\InterviewCriteria;
use App\Models\InterviewResult;

class InterviewResultFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InterviewResult::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'interview_criteria_id' => InterviewCriteria::factory(),
            'applicant_id' => Applicant::factory(),
            'response' => $this->faker->boolean,
        ];
    }
}
