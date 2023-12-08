<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('units')->insert([
            [
                'name' => 'Internal Audit'
            ],
            [
                'name' => 'Press and Public Relation'
            ],
            [
                'name' => 'Anticorruption and Transparency'
            ],
            [
                'name' => 'Legal'
            ],
            [
                'name' => 'SEVICOM'
            ],
            [
                'name' => 'Internal Security'
            ],
        ]);
    }

}
