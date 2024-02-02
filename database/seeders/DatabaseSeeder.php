<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Modules\Task\App\Models\Task;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate([
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'is_admin' => true,
            'password' => Hash::make('password'),
        ]);

        User::factory()->count(3)->user()->create();

        Task::factory()->count(5)->create();
    }
}
