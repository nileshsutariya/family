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
            'first_name' => 'admin',
            'middle_name' => 'admin',
            'last_name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'address' => 'Surat, Gujarat',
            'phone_no' => '1234567890',
            'date_of_birth' => Carbon::create('1992', '12', '25')->format('Y-m-d'),
            'gender' => 'male',
            'role_type' => '1'
        ]);
    }
}
