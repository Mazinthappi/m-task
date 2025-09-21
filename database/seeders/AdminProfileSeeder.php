<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            "username" => "Accountadmin",
            "email" => "Accountadmin@gmail.com",
            "is_super_admin" => 1,
            "password" => bcrypt("12345678"),
        ]);
        DB::table('user_profiles')->insert([
            "user_id" => 1,
            "first_name" => 'Account',
            'last_name' => 'admin',
            'mobile' => '98323645234',
        ]);
    }
}
