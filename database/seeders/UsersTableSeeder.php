<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user=User::where('email', 'superadmin@gmail.com')->first();

        if(!$user){
            User::create([
                'first_name'=>'Super',
                'last_name'=>'Admin',
                'email'=>'superadmin@gmail.com',
                'role'=>'superadmin',
                'password' => Hash::make('superadmin@gmail.com'),
            ]);
        }
    }
}
