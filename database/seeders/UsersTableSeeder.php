<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        {
            User::create([
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'password' => Hash::make('password123'),
            ]);
    
            User::create([
                'name' => 'Jane Smith',
                'email' => 'jane.smith@example.com',
                'password' => Hash::make('password456'),
            ]);
    
            User::create([
                'name' => 'Mark Johnson',
                'email' => 'mark.johnson@example.com',
                'password' => Hash::make('password789'),
            ]);
    
            User::create([
                'name' => 'Emily Davis',
                'email' => 'emily.davis@example.com',
                'password' => Hash::make('password101'),
            ]);
    
            User::create([
                'name' => 'Lucas Brown',
                'email' => 'lucas.brown@example.com',
                'password' => Hash::make('password112'),
            ]);
        }
    }
}
