<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    \App\Models\User::create([
        'name' => 'Admin',
        'email' => 'admin@example.com',
        'email_verified_at' => now(),
        'password' => bcrypt('password'), // ubah password
        'role' => 'admin',
    ]);
}

}
