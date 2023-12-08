<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Employee;
use App\Models\Promotion;

class PromotionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Promotion::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'employee_id' => Employee::factory(),
            'old_job_title' => $this->faker->word,
            'new_job_title' => $this->faker->word,
            'promotion_date' => $this->faker->date(),
            'next_promotion_due_date' => $this->faker->date(),
            'created_by' => $this->faker->word,
        ];
    }
}
