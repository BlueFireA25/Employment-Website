<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Demo 1',
            'email' => 'demo1@example.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('demo1234'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Demo 2',
            'email' => 'demo2@example.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('demo1234'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Demo 3',
            'email' => 'demo3@example.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('demo1234'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
