<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Discipline;
use App\Models\Employee;
use App\Models\User;

class DisciplineFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Discipline::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'employee_id' => Employee::factory(),
            'offence_desc' => $this->faker->text,
            'action_taken' => $this->faker->text,
            'reported_by' => User::factory(),
        ];
    }
}
