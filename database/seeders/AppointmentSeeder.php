<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Time;
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
        $doctors = User::whereHas('role', function($q) {
            $q->where('name', '=', 'doctor');
        });

        // Create some appointments for each doctor
        $doctors->each(function ($doctor, $index) {

            // Store current date
            $date = date('Y-m-d');

            // Create 5 appointments
            for ($i = 0; $i < 5; $i++){

                // Find tomorrow's date as Unix timestamp
                $repeat = strtotime('+1 day', strtotime($date));

                // Find target date as string
                $date = date('Y-m-d', $repeat);

                // Create appointment
                $appointment = Appointment::create([
                    'user_id' => $doctor->id,
                    'date' => $date,
                ]);

                $startTime = strtotime('2022-01-01 06:00');
                $endTime = strtotime('2022-01-01 21:40');

                // Loop between timestamps, 20 minutes at a time
                for ($j = $startTime; $j <= $endTime; $j = $j + 1200) {
                    Time::create([
                        'appointment_id' => $appointment->id,
                        'time' => (date('i', $j) === '00' ? date('ga', $j) : date('g.ia', $j)),
                        'status' => 0,
                    ]);
                }
            }
        });
    }
}
