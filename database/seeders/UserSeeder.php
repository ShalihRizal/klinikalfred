<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::table('users')->insert(
            [
                [
                    'id'           => '1',
                    'name'         => 'Rizal Pangandaran',
                    'email'         => 'rizalpangandaran@gmail.com',
                    'password'     => Hash::make('12345678'),
                    'role'            => '1',
                ],
                [
                    'id'           => '2',
                    'name'         => 'Shalih Rizal',
                    'email'         => 'shalihrizal@gmail.com',
                    'password'     => Hash::make('12345678'),
                    'role'            => '1',
                ],
            ]
        );
    }
}
