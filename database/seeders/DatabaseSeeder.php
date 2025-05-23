<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => hash::make('123123123'),
        ]);

        DB::table('users')->insert([
            'name' => 'opik',
            'email' => 'trahman.student@unibamadura.ac.id',
            'password' => hash::make('123123123'),
        ]);

        DB::table('users')->insert([
            'name' => 'nurma',
            'email' => 'nurmakkiyah.student@unibamadura.ac.id',
            'password' => hash::make('123123123'),
        ]);

        DB::table('alphas')->insert([
            'alpha' => '0.3',
        ]);
    }
}
