<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_status')->insert([
            ['id' => 1, 'name' => 'Pending', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Approved', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Rejected', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
