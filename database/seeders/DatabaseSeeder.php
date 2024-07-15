<?php

namespace Database\Seeders;

use App\Models\User;
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
        /**
         * Create three users, one as a sysadmin, and two as doctors.
         */
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@healthcare.com',
            'password' => Hash::make('admin123'),
            'is_admin' => true,
            'is_doctor' => false,
        ]);

        DB::table('users')->insert([
            'name' => 'John Doector',
            'email' => 'john.doector@healthcare.com',
            'password' => Hash::make('password'),
            'is_admin' => false,
            'is_doctor' => true,
        ]);

        DB::table('users')->insert([
            'name' => 'Jane Doector',
            'email' => 'jane.doector@healthcare.com',
            'password' => Hash::make('password'),
            'is_admin' => false,
            'is_doctor' => true,
        ]);

        $this->call([
            PatientSeeder::class,
            PatientSexSeeder::class,
        ]);
    }
}
