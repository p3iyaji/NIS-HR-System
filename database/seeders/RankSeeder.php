<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ranks')->insert([
            [
                'rank' => 'Comptroller General of Immigration (CGI)',
                'grade_level'=> 'Consolidated'
            ],
            [
                'rank' => 'Deputy Comptroller General (DCG)',
                'grade_level'=> 'Consolidated'
            ],
            [
                'rank' => 'Assistant Comptroller General (ACG)',
                'grade_level'=> 'COMPASS 16'
            ],
	        [
                'rank' => 'Comptroller of Immigration (CIS)',
                'grade_level'=> 'COMPASS 15'
            ],
            [
                'rank' => 'Deputy Comptroller of Immigration (DCI)',
                'grade_level'=> 'COMPASS 14'
                    ],
            [
                'rank' => 'Assistant Comptroller of Immigration (ACI)',
                'grade_level'=> 'COMPASS 13'
            ],
	[
        'rank' => 'Chief Superintendent of Immigration (CSI)',
        'grade_level'=> 'COMPASS 12'
            ],
	[
                'rank' => 'Superintendent of Immigration (SI)',
                'grade_level'=> 'COMPASS 11'
            ],
	[
        'rank' => 'Deputy Superintendent of Immigration (DSII)',
        'grade_level'=> 'COMPASS 10'
    ],
	[
        'rank' => 'Assistant Superintendent of Immigration-1 (ASI)',
        'grade_level'=> 'COMPASS 09'
            ],
	[
                'rank' => 'Assistant Superintendent of Immigration-2 (AS2)',
                'grade_level'=> 'COMPASS 08'
            ],
	[
        'rank' => 'Inspector of immigration (II)',
        'grade_level'=> 'COMPASS 07'
            ],
	[
                'rank' => 'Chief Immigration Assistant (CIA)',
                'grade_level'=> 'COMPASS 07'
            ],
	[
        'rank' => 'Assistant Inspector of Immigration (AII)',
        'grade_level'=> 'COMPASS 06'
            ],
	[
                'rank' => 'Senior Immigration Assistant (SIA)',
                'grade_level'=> 'COMPASS 06'
            ],
	[
        'rank' => 'Immigration Assistant – 1 (IA)',
        'grade_level'=> 'COMPASS 05'
            ],
	[
                'rank' => 'Immigration Assistant – 2 (IA)',
                'grade_level'=> 'COMPASS 04'
            ],
	[
        'rank' => 'Immigration Assistant – 3 (IA)',
        'grade_level'=> 'COMPASS 03'
    ],

        ]);
    }
}
