<?php

namespace App\Http\Controllers;

use Mail;
use Exception;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Time;
use App\Models\User;
use App\Models\Booking;
use App\Models\Prescription;
use App\Mail\AppointmentMail;

class FrontendController extends Controller
{

    public function index()
    {
    	date_default_timezone_set('Europe/London');
        if(request('date')) {
            $appointments = $this->findAppointmentsBasedOnDate(request('date'));
        } else {
            $appointments = Appointment::where('date', date('Y-m-d'))->get();
        }
    	return view('welcome', compact('appointments'));
    }

    public function store(Request $request)
    {
    	date_default_timezone_set('Europe/London');
        
        $request->validate(['time' => 'required']);
        $check = $this->checkBookingTimeInterval();
        if($check) {
            return redirect()->back()->with('message', 'You have already booked an appointment. Please wait to make next appointment.');
        }

        Booking::create([
            'user_id' => auth()->user()->id,
            'doctor_id' => $request->doctorId,
            'time' => $request->time,
            'date' => $request->date,
            'status' => 0,
        ]);

        Time::where('appointment_id', $request->appointmentId)
            ->where('time', $request->time)
            ->update(['status' => 1]);

        $doctorName = User::where('id', $request->doctorId)->first();

        $mailData = [
            'name' => auth()->user()->name,
            'time' => $request->time,
            'date' => $request->date,
            'doctorName' => $doctorName->name,
        ];

        try{
           Mail::to(auth()->user()->email)->send(new AppointmentMail($mailData));
        } catch(Exception $e) {

        }

        return redirect()->back()->with('message', 'Your appointment was booked');
    }

    private function findAppointmentsBasedOnDate(string $date)
    {
        $appointments = Appointment::where('date', $date)->get();
        return $appointments;
    }

    private function checkBookingTimeInterval()
    {
        return Booking::orderby('id', 'desc')
            ->where('user_id', auth()->user()->id)
            ->whereDate('created_at', date('Y-m-d'))
            ->exists();
    }
}
