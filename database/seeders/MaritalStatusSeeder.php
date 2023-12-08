<?php

namespace Database\Seeders;

use App\Models\MaritalStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaritalStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $marital_statuses = [
            'Single',
            'Married',
            'Divorced',
            'Widowed',
            ];

        foreach ($marital_statuses as $status) {
            MaritalStatus::create(['status' => $status]);
        }
    }
}
