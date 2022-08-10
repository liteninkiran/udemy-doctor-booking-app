<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Appointment;
use App\Models\Time;
use App\Models\Prescription;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $myAppointments = Appointment::latest('date')->where('user_id', auth()->user()->id)->get();
        return view('admin.appointment.index',compact('myAppointments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.appointment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'date' => ['required', 'unique:appointments,date,NULL,id,user_id,' . Auth::id(), 'date_format:Y-m-d'],
            'time' => ['required'],
        ]);

        $appointment = Appointment::create([
            'user_id'=> auth()->user()->id,
            'date' => $request->date
        ]);

        foreach($request->time as $time){
            Time::create([
                'appointment_id' => $appointment->id,
                'time' => $time,
            ]);
        }

        return redirect()->back()->with('message', 'Appointment created for '. $request->date);
    }

    /**
     * Check something...
     *
     * @param  Request  $request
     * @return Response
     */
    public function check(Request $request) {
        $date = $request->date;
        $appointment= Appointment::where('date', $date)->where('user_id', auth()->user()->id)->first();
        if(!$appointment) {
            return redirect()->to('/appointment')->with('error', 'Appointment time not available for this date');
        }
        $appointmentId = $appointment->id;
        $times = Time::where('appointment_id', $appointmentId)->get();

        return view('admin.appointment.index', compact('times', 'appointmentId', 'date'));
    }

    /**
     * Update something...
     *
     * @param  Request  $request
     * @return Response
     */
    public function updateTime(Request $request) {
        $appointmentId = $request->appointmentId;
        $appointment = Time::where('appointment_id', $appointmentId)->delete();
        foreach($request->time as $time) {
            Time::create([
                'appointment_id' => $appointmentId,
                'time' => $time,
                'status' => 0,
            ]);
        }
        return redirect()->route('appointment.index')->with('message', 'Appointment time updated');
    }
}
