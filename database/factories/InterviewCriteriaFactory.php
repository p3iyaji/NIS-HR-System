<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\InterviewCriteria;

class InterviewCriteriaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InterviewCriteria::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'criteria' => $this->faker->word,
        ];
    }
}
