<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WeightTarget;

class WeightTargetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WeightTarget::create([
            'user_id' => 1,
            'target_weight' => 65.0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
