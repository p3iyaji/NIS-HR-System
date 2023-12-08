<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Grade_level;

class GradeLevelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GradeLevel::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'grade' => $this->faker->word,
        ];
    }
}
