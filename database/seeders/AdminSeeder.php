<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrateur',
            'email' => 'admin@clinique.sn',
            'telephone' => '770000000',
            'role' => 'admin',
            'password' => Hash::make('Admin@2026'),
            'email_verified_at' => now(),
        ]);
    }
}