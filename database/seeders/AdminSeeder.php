<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $documentSourcePath = database_path('seeders/files/adhar.jpeg');
        $profileSourcePath = database_path('seeders/files/profile.jpg');

        $documentTargetPath = public_path('documents/adhar.jpeg');
        $profileTargetPath = public_path('profile/profile.jpg');

        File::ensureDirectoryExists(public_path('documents'));
        File::ensureDirectoryExists(public_path('profile'));

        File::copy($documentSourcePath, $documentTargetPath);
        File::copy($profileSourcePath, $profileTargetPath);

        \DB::table('admin')->insert([
            'elder' => 'yes',
            // 'elder_ph_no' => '1234567809',
            'ph_no' => '1234567890',            
            'password' => Hash::make('123456'),
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
            'c_address' => 'mumbai',
            'c_district' => 'mumbai', 
            'c_taluka' => 'mumbai',
            'c_village' => 'mumbai',
            'v_address' => 'bhavnagar',
            'v_district' => 'bhavnagar', 
            'v_taluka' => 'bhavnagar',
            'v_village' => 'bhavnagar',
            'education' => 'BCA',
            'profession' => 'business',
            'company_name' => 'company',
            'business_category' => 'company',
            'document' => 'aadharcard',
            'document_upload' => 'adhar.jpeg', 
            'profile_photo' => 'profile.jpg', 
            // 'role_type' => 'admin',
            'approve_status' => '1'
        ]);
    }
}
