<?php

namespace Database\Seeders;


use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('parts')->insert([
            'name' => 'brake shoe',
            'model' => '5 series',
            'partnumber' => 'MD8829S',
            'year' => 2011,
            'make' => 'bmw',
            'user_id' => 3,
            'created_at' =>null,
            'updated_at' =>null
        ]);
        DB::table('parts')->insert([
            'name' => 'POWER STEERING PUMP',
            'model' => '5 series',
            'partnumber' => '7802622',
            'year' => '2008',
            'make' => 'bmw',
            'user_id' => 3,
            'created_at' =>null,
            'updated_at' =>null
        ]);
        DB::table('parts')->insert([
            'name' => 'Inyector',
            'model' => 'land cruiser',
            'partnumber' => '23670-30080',
            'year' => '2010',
            'make' => 'toyota',
            'user_id' => 4,
            'created_at' =>null,
            'updated_at' =>null
        ]);
        DB::table('parts')->insert([
            'name' => 'Air Filter',
            'model' => 'S class',
            'partnumber' => 'E747L-2',
            'year' => 2016,
            'make' => 'MB',
            'user_id' => 5,
            'created_at' =>null,
            'updated_at' =>null
        ]);
        DB::table('parts')->insert([
            'name' => 'AirBag',
            'model' => 'A8',
            'partnumber' => 'AU121018-062',
            'year' => 2015,
            'make' => 'Audi',
            'user_id' => 6,
            'created_at' =>null,
            'updated_at' =>null
        ]);




    }
}
