<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Appointment;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Find all doctors
        $users = User::whereHas('role', function($q) {
            $q->where('name', '=', 'doctor');
        });

        // Create some appointments for each doctor
        $users->each(function ($user, $index) {
            Appointment::factory(50)->create(['user_id' => $user->id]);
        });
    }
}
