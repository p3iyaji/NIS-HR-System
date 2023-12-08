<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\EmpQualification;
use App\Models\Employee;

class EmpQualificationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EmpQualification::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'employee_id' => Employee::factory(),
            'institution' => $this->faker->word,
            'certificate_obtained' => $this->faker->word,
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->word,
        ];
    }
}
