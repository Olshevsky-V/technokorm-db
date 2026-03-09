<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create(
            [
                'name' => 'admin',
                'role' => 1,
                'email' => 'admin@mail.com',
                'password' => bcrypt('12345')
            ]
        );
        \App\Models\User::create(
            [
                'name' => 'admin2',
                'role' => 1,
                'email' => 'admin2@mail.com',
                'password' => Hash::make('12345')
            ]
        );
    }
}
