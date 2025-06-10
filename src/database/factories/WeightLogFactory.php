<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WeightLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'date' => $this->faker->dateTimeBetween('-35 days','now')->format('Y-m-d'),
            'weight' => $this->faker->randomFloat(1,40,150),
            'calories' => $this->faker->numberBetween(1500,3000),
            'exercise_time' => $this->faker->numberBetween(0,120),
            'exercise_content' => $this->faker->randomElement(['ランニング','ウォーキング','筋トレ','ストレッチ']),
        ];
    }
}
