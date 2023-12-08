<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\EmpCertification;
use App\Models\Employee;

class EmpCertificationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EmpCertification::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'employee_id' => Employee::factory(),
            'certification_name' => $this->faker->word,
            'issuing_authority' => $this->faker->word,
            'date_obtained' => $this->faker->date(),
        ];
    }
}
