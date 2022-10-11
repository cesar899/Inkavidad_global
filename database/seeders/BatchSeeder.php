<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('batches')->insert([
        	'project_id' => 1,
            'user_id' => 5,
            'seller_id' => 4,
            'group_id' => 1,
            'name' => 'prueba',
            'mts_north' => '50',
            'mts_south' => '50',
            'mts_est' => '50',
            'mts_west' => '50',
            'adjoins_north' => '50',
            'adjoins_south' => '50',
            'adjoins_est' => '50',
            'adjoins_west' => '50',
            'amount_owed' => 500,
            'amount' => 5000,
            'status' => 0,
        	"created_at" => date('Y-m-d H:m:s'),
            "updated_at" => date('Y-m-d H:m:s'),
        ]);
    }
}
