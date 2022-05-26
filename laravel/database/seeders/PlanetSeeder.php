<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $obstacles = [];
        $init = 0;
        while($init <= 50) {
            $obstacles[$init]['x'] = rand(1,200);
            $obstacles[$init]['y'] = rand(1,200);

            $init++;
        }

        DB::table('planet')->insert([
            [
                "bounding_box" => '{
                    "x": 200,
                    "y": 200
                }',
                "obstacles" => json_encode($obstacles),
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ]
        ]);
    }
}
