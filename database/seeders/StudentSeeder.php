<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $programs = ['BS Computer Science', 'BS Software Engineering', 'BS Information Technology', 'BS Data Science'];
        $mohallahs = ['Farooq-e-Azam', 'Siddiq-e-Akbar', 'Usman-e-Ghani', 'Ali-ul-Murtaza'];
        $universities = ['University of Example', 'Tech Institute', 'Science University', 'City College'];

        for ($i = 1; $i <= 50; $i++) {
            $appNo = 'ST-' . str_pad($i, 4, '0', STR_PAD_LEFT);
            $its = 'ITS-' . str_pad($i, 4, '0', STR_PAD_LEFT);
            $phone = '03' . $faker->numberBetween(10000000, 99999999);
            
            // Create student
            DB::table('students')->insert([
                'appNo' => $appNo,
                'name' => $faker->name,
                'email' => 'student' . $i . '@example.com',
                'password' => Hash::make('password123'),
                'phone' => $phone,
                'address' => $faker->address,
                'its' => $its,
                'mohallah' => $faker->randomElement($mohallahs),
                'dob' => $faker->dateTimeBetween('-25 years', '-18 years')->format('Y-m-d'),
                'program' => $faker->randomElement($programs),
                'role' => 'student',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Create 3 result records for each student
            for ($semester = 1; $semester <= 3; $semester++) {
                $gpa = $faker->randomFloat(2, 2.0, 4.0);
                $cgpa = $semester == 1 ? $gpa : $faker->randomFloat(2, $gpa - 0.5, $gpa + 0.5);
                
                DB::table('results')->insert([
                    'app_no' => $appNo,
                    'uniName' => $faker->randomElement($universities),
                    'semester' => 'Semester ' . $semester,
                    'gpa' => $gpa,
                    'cgpa' => $cgpa,
                    'resultFile' => 'result_' . $appNo . '_sem' . $semester . '.pdf',
                    'feesFile' => 'fees_' . $appNo . '_sem' . $semester . '.pdf',
                    'remarks' => $faker->randomElement(['Good progress', 'Needs improvement', 'Excellent performance', 'No remarks']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}