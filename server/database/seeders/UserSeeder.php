<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'avatar' => 0,
            'phone' => rand(10,100),
            'address' => 'admin',
            'created_at' =>null,
            'updated_at' =>null,
            'type'=> 'admin'
        ]);
        DB::table('users')->insert([
            'name' => 'admin2',
            'email' => 'admin2@admin.com',
            'password' => Hash::make('admin'),
            'avatar' => 'admin',
            'phone' => rand(10,100),
            'address' => 'admin',
            'created_at' =>null,
            'updated_at' =>null,
            'type'=> 'admin'
        ]);
        DB::table('users')->insert([
            'name' => 'John',
            'email' => 'john@gmail.com',
            'password' => Hash::make('john12345'),
            'avatar' => '244939541742696260.jpg',
            'phone' => rand(10,100),
            'address' => Str::random(10),
            'created_at' =>null,
            'updated_at' =>null
        ]);
        DB::table('users')->insert([
            'name' => 'Bob',
            'email' => 'bob@gmail.com',
            'password' => Hash::make('bob12345'),
            'avatar' => '200859416110144.jpg',
            'phone' => rand(10,100),
            'address' => Str::random(10),
            'created_at' =>null,
            'updated_at' =>null
        ]);
        DB::table('users')->insert([
            'name' => 'Mason',
            'email' => 'mason@gmail.com',
            'password' => Hash::make('mason12345'),
            'avatar' => '44371263363765624.jpg',
            'phone' => rand(10,100),
            'address' => Str::random(10),
            'created_at' =>null,
            'updated_at' =>null
        ]);
        DB::table('users')->insert([
            'name' => 'Charlotte',
            'email' => 'charlotte@gmail.com',
            'password' => Hash::make('charlotte12345'),
            'avatar' => '131382396407607410.jpg',
            'phone' => rand(10,100),
            'address' => Str::random(10),
            'created_at' =>null,
            'updated_at' =>null
        ]);

    }
}
