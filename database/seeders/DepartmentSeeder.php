<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departments')->insert([
            [
                'name' => 'Boarder Management'
            ],
            [
                'name' => 'Visa and Residency'
            ],
            [
                'name' => 'Migration'
            ],
            [
                'name' => 'Passport and other Travel Documents'
            ],
            [
                'name' => 'Human Resource Management'
            ],
            [
                'name' => 'Planning, Research and Statistics'
            ],
            [
                'name' => 'Investigation and Compliance'
            ],
            [
                'name' => 'Medical Services'
            ],
            [
                'name' => 'Logistics Services'
            ],
        ]);
    }

}
