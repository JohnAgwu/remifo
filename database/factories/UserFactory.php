<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => "Lyte Onyema",
            'email' => 'lyte.onyema@gmail.com',
            'phone' => $this->faker->unique()->numerify('###########'),
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // password
            'remember_token' => Str::random(10),
        ];
    }


//    public function configure()
//    {
//        return $this->afterCreating(function (User $user) {
//            $user->reminder()->create([
//                'title' => $this->faker->text(10),
//                'description' => $this->faker->text(50),
//                'start_date' => $this->faker->dateTimeBetween('now', '+2 weeks'),
//                'end_date' => $this->faker->dateTimeBetween('+2 months', '+5 months'),
//                'interval' => array_rand(array_flip(['DAILY', 'WEEKLY', 'MONTHLY', 'YEARLY'])),
//                'frequency' => rand(1, 5),
//                'is_done' => array_rand([true, false]),
//            ]);
//        });
//    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => now(),
            ];
        });
    }
}
