<?php

namespace Database\Seeders;

use App\Models\InterviewResult;
use Illuminate\Database\Seeder;

class InterviewResultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InterviewResult::factory()->count(5)->create();
    }
}
