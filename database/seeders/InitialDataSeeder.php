<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;

class InitialDataSeeder extends Seeder
{
    public function run(): void
    {
       
        $user = User::create([
            'name' => 'abd',
            'email' => 'abd@gmail.com',
            'password' => Hash::make('123456789'),
        ]);

        $categories = ['Work', 'Study', 'Personal', 'Urgent'];
        foreach ($categories as $name) {
            Category::create(['name' => $name]);
        }

        
    }
}
