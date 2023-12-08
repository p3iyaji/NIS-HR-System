<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Employee;
use App\Models\Training;
use App\Models\User;

class TrainingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Training::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'employee_id' => Employee::factory(),
            'training_title' => $this->faker->word,
            'training_instite' => $this->faker->word,
            'training_location' => $this->faker->word,
            'training_duration' => $this->faker->word,
            'training_date_from' => $this->faker->date(),
            'training_date_to' => $this->faker->date(),
            'created_by' => User::factory(),
        ];
    }
}
