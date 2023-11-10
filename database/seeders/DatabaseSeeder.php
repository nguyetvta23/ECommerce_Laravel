<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'm_avatar' => 'admin.png',
            'role' => 1,
            'password' => Hash::make('admin@gmail.com')
        ]);
        $this -> call([
            UserSeeder::class
        ]);
    }
}
