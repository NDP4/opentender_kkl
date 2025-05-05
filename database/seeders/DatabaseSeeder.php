<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin KKL',
            'email' => 'panitiakkl@dti.com',
            'password' => Hash::make('panitiakkl23'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // if (auth()->user()->role === 'biro') {
        //     return view('dashboard.biro');
        // }
    }
}
