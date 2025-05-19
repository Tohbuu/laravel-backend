<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@portfolio.com',
            'password' => bcrypt('password123'),
        ]);

        User::factory(10)->create()->each(function ($user) {
            $user->portfolio()->create([
                'title' => $user->name . "'s Portfolio",
                'about' => 'This is my professional portfolio',
                'theme_color' => '#'.dechex(rand(0x000000, 0xFFFFFF)),
            ]);
        });
    }
}