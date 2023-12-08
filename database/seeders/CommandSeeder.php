<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table( 'commands')->insert([
            [
                 'command' =>  'Service Headquarter (SHQ) '
             ],
             [
                  'command' => 'Zonal Command'
             ],
            [
          'command' => 'Special and State Command'
            ],
            [
          'command' => 'Area Command '
             ],
 	        [
                  'command' => 'Local Government Command'
             ],
         ]);

    }
}
