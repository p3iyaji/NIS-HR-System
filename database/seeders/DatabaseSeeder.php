<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\MaritalStatus;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            TypesSeeder::class,
            GenderSeeder::class,
            StatusSeeder::class,
            CommandSeeder::class,
            NationalitySeeder::class,
            MaritalStatusSeeder::class,
            DesignationSeeder::class,
            RankSeeder::class,
            GeoStateSeeder::class,
            GeoLgaSeeder::class,
            UserRoleSeeder::class,
            UserSeeder::class,
            JobPositionSeeder::class,
            InterviewCriteriaSeeder::class,
        ]);
    }
}
