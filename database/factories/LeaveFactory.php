<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Employee;
use App\Models\Leave;
use App\Models\User;

class LeaveFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Leave::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'employee_id' => Employee::factory(),
            'Leave_type' => $this->faker->word,
            'Leave_days' => $this->faker->word,
            'Leave_date_from' => $this->faker->date(),
            'Leave_date_to' => $this->faker->date(),
            'leave_reason' => $this->faker->word,
            'status' => $this->faker->randomElement(["Pending","Approved","Rejected"]),
            'created_by' => User::factory(),
            'approved_by' => User::factory(),
            'approved_at' => $this->faker->dateTime(),
        ];
    }
}
