<?php

namespace Modules\Authentication\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AuthenticationDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::updateOrCreate([
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'is_admin' => true,
            'password' => Hash::make('password'),
        ]);

    }
}
