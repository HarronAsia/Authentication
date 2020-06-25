<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->insert([
            [
                'uid' => '1',
                'title' => 'Test Seed',
                'detail' => 'Test Detail Seed',
                'is_published' => '1',
                'created_at' => Carbon::now(),
                'created_at' => Carbon::now(),
            ],
        ]);
    }
}
