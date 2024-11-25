<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'elder' => 'yes',
            // 'elder_ph_no' => '1234567809',
            'ph_no' => '1234567890',            
            'password' => Hash::make(value: '123456'),
            'first_name' => 'admin',
            'father_name' => 'admin',
            'mother_name' => 'admin',
            'last_name' => 'admin',
            'marital_status' => 'married',
            'spouse_name' => 'admin',
            'email' => 'admin@gmail.com',
            'gender' => 'male',
            'date_of_birth' => Carbon::create('1992', '12', '25')->format('Y-m-d'),
            'blood_group' => 'A+',
            'c_address' => 'surat',
            'c_district' => 'surat', 
            'c_taluka' => 'surat',
            'c_village' => 'surat',
            'v_address' => 'bhavnagar',
            'v_district' => 'bhavnagar', 
            'v_taluka' => 'bhavnagar',
            'v_village' => 'bhavnagar',
            'education' => 'BCA',
            'profession' => 'business',
            'company_name' => 'company',
            'business_category' => 'company',
            'role_type' => '1'
        ]);
    }
}
