<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CarPartImages extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('part_images')->insert([
            'user_id'=>3,
            'part_id'=>1,
            'avatar'=>'1/5534900853769.jpg'
        ]);
        DB::table('part_images')->insert([
            'user_id'=>3,
            'part_id'=>1,
            'avatar'=>'2/310741323596082300.jpg'
        ]);
        DB::table('part_images')->insert([
            'user_id'=>3,
            'part_id'=>1,
            'avatar'=>'3/225199600704.jpg'
        ]);
        DB::table('part_images')->insert([
            'user_id'=>3,
            'part_id'=>2,
            'avatar'=>'1/947200518061237500.jpg'
        ]);
        DB::table('part_images')->insert([
            'user_id'=>3,
            'part_id'=>2,
            'avatar'=>'2/52029213562955160.jpg'
        ]);
        DB::table('part_images')->insert([
            'user_id'=>3,
            'part_id'=>2,
            'avatar'=>'3/681109645043243500.jpg'
        ]);
        DB::table('part_images')->insert([
            'user_id'=>4,
            'part_id'=>3,
            'avatar'=>'1/29721861554176.jpg'
        ]);
        DB::table('part_images')->insert([
            'user_id'=>4,
            'part_id'=>3,
            'avatar'=>'2/16777216000000.jpg'
        ]);
        DB::table('part_images')->insert([
            'user_id'=>4,
            'part_id'=>3,
            'avatar'=>'3/7896739287939062021.jpg'
        ]);
        DB::table('part_images')->insert([
            'user_id'=>5,
            'part_id'=>4,
            'avatar'=>'1/685478051557568400.jpg'
        ]);
        DB::table('part_images')->insert([
            'user_id'=>5,
            'part_id'=>4,
            'avatar'=>'2/12827693806929.jpg'
        ]);
        DB::table('part_images')->insert([
            'user_id'=>5,
            'part_id'=>4,
            'avatar'=>'3/60179143072269380.jpg'
        ]);
        DB::table('part_images')->insert([
            'user_id'=>6,
            'part_id'=>5,
            'avatar'=>'1/68077742987260160.jpg'
        ]);
        DB::table('part_images')->insert([
            'user_id'=>6,
            'part_id'=>5,
            'avatar'=>'2/111726661732987460.jpg'
        ]);
        DB::table('part_images')->insert([
            'user_id'=>6,
            'part_id'=>5,
            'avatar'=>'3/1973822685184.jpg'
        ]);
    }
}
