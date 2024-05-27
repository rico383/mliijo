<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run():void
    {
        DB::table('users')->insert([[
            'name'=>'Rico',
            'password'=>Hash::make('123'),
            'email'=>'rico@gmail.com',
            'number'=>'085155421904',
            'address'=>'Home',
            'created_at'=>now(),
            'updated_at'=>now(),
        ],
        [
            'name'=>'Fiona',
            'password'=>Hash::make('123'),
            'email'=>'fiona@gmail.com',
            'number'=>'12345678',
            'address'=>'Home',
            'created_at'=>now(),
            'updated_at'=>now(),
        ],
    ],
    );
    }
}
