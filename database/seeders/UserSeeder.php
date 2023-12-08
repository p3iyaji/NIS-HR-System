<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'email' => 'admin@admin.com',
                'password' => bcrypt('password'),
                'first_name' => 'John',
                'last_name' => 'Paul',
                'is_active' => 1,
                'email_verified_at' => now(),
                'profile_picture' => '',
                'user_role_id' => 1,
                'created_at' => now()
            ]
        ]);
    }
}
