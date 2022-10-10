<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
        	'bank_name' => 'Banco de Venezuela',
            'ref_number' => '123456',
            'payment_proof' => '123456',
            'status' => 0,
            'user_id' => 5,
            'seller_id' => 4,
            'batch_id' => 1,
        	"created_at" => date('Y-m-d H:m:s'),
            "updated_at" => date('Y-m-d H:m:s'),
        ]);
    }
}
