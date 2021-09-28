<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

//DB
use Illuminate\Support\Facades\DB;

class DisabledsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('disableds')->insert(
            [
                'disabled_id' => config('const.DISABLED_STATUS.DISABLED'),
                'disabled_status_name' => '利用停止中'
            ]
        );
    }
}
