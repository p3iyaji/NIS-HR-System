<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Applicant;
use App\Models\Reference;

class ReferenceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reference::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'applicant_id' => Applicant::factory(),
            'referrer_name' => $this->faker->word,
            'referrer_email' => $this->faker->word,
            'referrer_mobile' => $this->faker->word,
            'relationship_applicant' => $this->faker->word,
        ];
    }
}
