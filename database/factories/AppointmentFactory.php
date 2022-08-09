<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Find a random doctor
        $user = User::whereHas('role', function($q) {
            $q->where('name', '=', 'doctor');
        })->inRandomOrder()->first();

        $date = $this->faker->dateTimeBetween($startDate = 'now', $endDate = '+1 month');

        return [
            'user_id' => $user->id,
            'date' => $date->format('Y-m-d'),
        ];
    }
}
