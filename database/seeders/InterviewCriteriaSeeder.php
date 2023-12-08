<?php

namespace Database\Seeders;

use App\Models\InterviewCriteria;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InterviewCriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('interview_criterias')->insert([
            [
                'criteria'=> 'English Proficiancy',
                'created_at' => now()
            ],
            [
                'criteria'=> 'Has Required Height',
                'created_at' => now()
            ],
            [
                'criteria'=> 'Has No Disability',
                'created_at' => now()
            ],
            [
                'criteria'=> 'Has Good Sight',
                'created_at' => now()
            ],
            [
                'criteria'=> 'Has Good Problem Solving Skills',
                'created_at' => now()
            ]
        ]);
    }
}
