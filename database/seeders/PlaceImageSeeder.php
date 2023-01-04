<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlaceImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('place_images')->insert([
            [
                'place_id'     => '1',
                'file_path'  => 'images/place/ho-guom/SXPm1hA17yt2mTtIWK917a4tGYq9v2Mg4l5e5MAb.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'place_id'     => '1',
                'file_path'  => 'images/place/ho-guom/g58JJ3PZ1GZUzdkRQoNfZMLZBp3e641G04ae4Dfg.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'place_id'     => '2',
                'file_path'  => 'images/place/lang-gom-bat-trang/nL0f819duJRj4lJeyD36MUSFW5ivdOQlZngStpdn.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'place_id'     => '2',
                'file_path'  => 'images/place/lang-gom-bat-trang/Y1Tr6t10XiyNoPkvuwF14ek0nyOQOb1Pf4lxoFf2.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'place_id'     => '3',
                'file_path'  => 'images/place/thien-duong-bao-son/jXJg9eUwkkuJCDLMADJIym79RpZBxPyf5dJIqTmF.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'place_id'     => '3',
                'file_path'  => 'images/place/thien-duong-bao-son/uGNhr0FR30j3t9Pc2xmsoc08vvHoiY1l1JeGPIBn.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'place_id'     => '4',
                'file_path'  => 'images/place/cau-long-bien/SJpFXOO1QQ8J57X9WIF08LVGBIvwjkJbPz4T9pKs.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'place_id'     => '4',
                'file_path'  => 'images/place/cau-long-bien/Kt6dT32yy619HIyoXCKlTcKq6CvRausYO4ZXpOEh.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'place_id'     => '6',
                'file_path'  => 'images/place/bai-truong/ToJM5zWshfHVhexaKBHJDmuFhPgWjMxzL2S4x9aF.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'place_id'     => '6',
                'file_path'  => 'images/place/bai-truong/nrGO725hxBA2xJiUppoDDY0TDUCHX0tmBZKnfQBO.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'place_id'     => '7',
                'file_path'  => 'images/place/hon-mong-tay/yPXP7cLSNlbRq8mPkq6FMefYevOatrld0XLP4Q54.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'place_id'     => '7',
                'file_path'  => 'images/place/hon-mong-tay/lwQobBl7AZkIBRvDH0Er8dGkXFZN2vMd7Te0yogc.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'place_id'     => '8',
                'file_path'  => 'images/place/nui-ham-lon/lMavaiJlv5Pa3x8HuscEaJQwifQsHa1sSzeWY4pv.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'place_id'     => '8',
                'file_path'  => 'images/place/nui-ham-lon/iWVnUnIr6Y2hmd1v8YqbFkl1kauOchBzvglyvObf.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'place_id'     => '9',
                'file_path'  => 'images/place/ba-na-hills/1zwqhHaeolePI6p6uQraq1R62LhckHBcPlDsYmel.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'place_id'     => '9',
                'file_path'  => 'images/place/ba-na-hills/U7WEBHauneBIarEGxstP35DDPhAt7IFCB0xZ8cxG.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'place_id'     => '10',
                'file_path'  => 'images/place/ban-dao-son-tra/uGmZVevw8ySIhTeg5h5YxVL6YLImj4q3rdDyRgL8.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'place_id'     => '10',
                'file_path'  => 'images/place/ban-dao-son-tra/59zIeiiofZzzScdi6GtWfyuJSVQCJBufMjwZqvmg.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
