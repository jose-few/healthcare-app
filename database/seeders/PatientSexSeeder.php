<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PatientSexSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('patient_sexes')->insert([
            'name' => 'male'
        ]);

        DB::table('patient_sexes')->insert([
            'name' => 'female'
        ]);

        DB::table('patient_sexes')->insert([
            'name' => 'non-binary'
        ]);

        DB::table('patient_sexes')->insert([
            'name' => 'prefer to self describe'
        ]);

        DB::table('patient_sexes')->insert([
            'name' => 'prefer not to say'
        ]);
    }
}
