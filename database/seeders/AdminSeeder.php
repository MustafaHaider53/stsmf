<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
    

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run()
    {
        Student::create([
            'appNo' => 'ADMIN001',
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Change the password
            'phone' => '1234567890',
            'address' => 'Admin Address',
            'its' => '50000000',
            'mohallah' => 'Admin Mohallah',
            'dob' => '1990-01-01',
            'program' => 'Admin Program',
            'role' => 'admin', // Set role to 'admin'
        ]);
    }
}
