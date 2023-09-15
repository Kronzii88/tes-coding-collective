<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            [
                'name' => 'Agus',
                'email' => 'agus@gmail.com',
                'password' => Hash::make('password123!'),
                'balance' => 1000000
            ],
            [
                'name' => 'Budi',
                'email' => 'budi@gmail.com',
                'password' => Hash::make('password123!'),
                'balance' => 2000000
            ],
            [
                'name' => 'Caca',
                'email' => 'caca@gmail.com',
                'password' => Hash::make('password123!'),
                'balance' => 1500000
            ],
        ];
        User::insert($data);
    }
}
