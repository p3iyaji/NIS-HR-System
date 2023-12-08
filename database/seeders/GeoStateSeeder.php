<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GeoStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

     public function run(): void
     {
         //geo_state seeder
         DB::table('geo_states')->insert([
             [
                 'name' => 'Abuja FCT'
             ],
             [
                 'name' => 'Abia'
             ],
             [
                 'name' => 'Adamawa'
             ],
             [
                 'name' => 'Akwa Ibom'
             ],
             [
                 'name' => 'Anambra'
             ],
             [
                 'name' => 'Bauchi'
             ],
             [
                 'name' => 'Bayelsa'
             ],
             [
                 'name' => 'Benue'
             ],
             [
                 'name' => 'Borno'
             ],
             [
                 'name' => 'Cross River'
             ],
             [
                 'name' => 'Delta'
             ],
             [
                 'name' => 'Ebonyi'
             ],
             [
                 'name' => 'Edo'
             ],
             [
                 'name' => 'Ekiti'
             ],
             [
                 'name' => 'Enugu'
             ],
             [
                 'name' => 'Gombe'
             ],
             [
                 'name' => 'Imo'
             ],
             [
                 'name' => 'Jigawa'
             ],
             [
                 'name' => 'Kaduna'
             ],
             [
                 'name' => 'Kano'
             ],
             [
                 'name' => 'Katsina'
             ],
             [
                 'name' => 'Kebbi'
             ],
             [
                 'name' => 'Kogi'
             ],
             [
                 'name' => 'Kwara'
             ],
             [
                 'name' => 'Lagos'
             ],
             [
                 'name' => 'Nassarawa'
             ],
             [
                 'name' => 'Niger'
             ],
             [
                 'name' => 'Ogun'
             ],
             [
                 'name' => 'Ondo'
             ],
             [
                 'name' => 'Osun'
             ],
             [
                 'name' => 'Oyo'
             ],
             [
                 'name' => 'Plateau'
             ],
             [
                 'name' => 'Rivers'
             ],
             [
                 'name' => 'Sokoto'
             ],
             [
                 'name' => 'Taraba'
             ],
             [
                 'name' => 'Yobe'
             ],
             [
                 'name' => 'Zamfara'
             ],
         ]);
     }

}