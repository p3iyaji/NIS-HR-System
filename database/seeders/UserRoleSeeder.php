<?php

namespace Database\Seeders;

use App\Models\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_roles')->insert([
            [
                'role_name' => 'Admin',
                'created_at' => now()
            ],
            [
                'role_name' => 'User',
                'created_at' => now()
            ],
        ]);
    }
}
