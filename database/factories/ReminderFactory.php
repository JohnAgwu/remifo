<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReminderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->numerify('###########'),
            'subject' => $this->faker->text(20),
            'body' => $this->faker->text(150),
            'start_date' => $this->faker->dateTimeBetween('now', '+2 weeks'),
            'end_date' => $this->faker->dateTimeBetween('+2 months', '+5 months'),
            'interval' => array_rand(array_flip(['DAILY', 'WEEKLY', 'MONTHLY', 'QUARTERLY', 'HALF-YEARLY', 'YEARLY'])),
            'frequency' => rand(1, 5),
            'is_done' => array_rand([true, false]),
        ];
    }
}
