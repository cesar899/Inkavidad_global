<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	'name' => 'Super',
        	'last_name' => 'Admin',
        	'email' => 'superadmin@valdusoft.com',
        	'password' => Hash::make('Admin11#'),
        	'rol' => 1,
        	"created_at" => date('Y-m-d H:m:s'),
            "updated_at" => date('Y-m-d H:m:s'),
        ]);
        DB::table('users')->insert([
            'name' => 'User',
        	'last_name' => 'Financial',
        	'email' => 'financial@valdusoft.com',
        	'password' => Hash::make('Financial11#'),
        	'rol' => 2,
        	"created_at" => date('Y-m-d H:m:s'),
            "updated_at" => date('Y-m-d H:m:s'),
        ]);
        DB::table('users')->insert([
            'name' => 'User',
        	'last_name' => 'Accountant',
        	'email' => 'accountant@valdusoft.com',
        	'password' => Hash::make('Acountant11#'),
        	'rol' => 3,
        	"created_at" => date('Y-m-d H:m:s'),
            "updated_at" => date('Y-m-d H:m:s'),
        ]);
        DB::table('users')->insert([
            'name' => 'User',
            'last_name' => 'Seller',
            'email' => 'seller@valdusoft.com',
            'password' => Hash::make('Seller11#'),
            'rol' => 4,
            "created_at" => date('Y-m-d H:m:s'),
            "updated_at" => date('Y-m-d H:m:s'),
        ]);
        DB::table('users')->insert([
        	'name' => 'User',
        	'last_name' => 'User',
        	'email' => 'user@valdusoft.com',
        	'password' => Hash::make('User11#'),
        	'rol' => 5,
        	"created_at" => date('Y-m-d H:m:s'),
            "updated_at" => date('Y-m-d H:m:s'),
        ]);
    }
}
