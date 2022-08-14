<?php

namespace Database\Seeders;

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
        $insert = [
            [
                'nama' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'),
                'created_at' => now(),
            ],
        ];
        User::insert($insert);
    }
}
