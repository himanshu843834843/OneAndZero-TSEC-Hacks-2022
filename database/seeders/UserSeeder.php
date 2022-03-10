<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'  =>  'Himanshu Otwani',
            'email' =>  'himanshuotwani@gmail.com',
            'role'  =>  'admin',
            'email_verified_at' =>  Carbon::now(),
            'password'  =>  Hash::make('password')
        ]);
        User::create([
            'name'  =>  'Sidharath Mankani',
            'email' =>  'sidharathmankani@gmail.com',
            'role'  =>  'member',
            'email_verified_at' =>  Carbon::now(),
            'password'  =>  Hash::make('password')
        ]);
    }
}
