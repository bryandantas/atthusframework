<?php

namespace Database\Seeders;

use App\Enums\RolesType;
use App\Models\User;
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
        $user = new User([
            'name' => 'Admin',
            'email' => 'admin@atthus.com.br',
            'password' => Hash::make('teste123'),
            'email_verified_at' => now(),
        ]);
        $user->save();

        $user->assignRole(RolesType::ADMIN);

    }
}
