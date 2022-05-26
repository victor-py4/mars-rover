<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rovers')->insert([
            [
                "name" => 'rover_001',
                "position" => '{
                    "x": 1,
                    "y": 1
                }',
                "reports" => '[{}]',
                "instructions" => '[{}]',
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ]
        ]);
    }
}
