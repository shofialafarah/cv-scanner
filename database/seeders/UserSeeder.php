<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => config('services.admin.name'),
            'email' => config('services.admin.email'),
            'password' => Hash::make(config('services.admin.password')),
            'role'  => 'hr',
            'email_verified_at' => now(),
        ]);
    }
}
