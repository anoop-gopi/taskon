<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_categories')->insert([
            [
                'id' => 1,
                'name' => 'Free',
                'tasks_per_week' => 1,
                'earning_per_task' => 0,
                'price' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'name' => 'Basic',
                'tasks_per_week' => 10,
                'earning_per_task' => 100,
                'price' => 50, // Monthly price
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 3,
                'name' => 'Pro',
                'tasks_per_week' => 20,
                'earning_per_task' => 150,
                'price' => 100, // Monthly price
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 4,
                'name' => 'Premium',
                'tasks_per_week' => 30,
                'earning_per_task' => 200,
                'price' => 150, // Monthly price
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
