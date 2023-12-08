<?php

namespace Database\Seeders;

use App\Models\Designation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table( 'designations')->insert([
            [
                'designation' =>  'Accountant'
            ],
            [
                'designation' => 'Procurement Officer'
            ],

        ]);
    }
}
