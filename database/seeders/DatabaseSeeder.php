<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        \App\Models\User::factory()->create([
            'name' => 'Josem',
            'username' => 'josemdev',
            'email' => 'test@example.com',
            'password' => bcrypt('password'), // password
        ]);
        \App\Models\User::factory(10)->create();
        \App\Models\Post::factory(200)->create();
    }
}
