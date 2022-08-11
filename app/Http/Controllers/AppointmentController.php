<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Time;
use App\Models\Appointment;
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
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            // 'date' => ['required', 'unique:appointments,date,NULL,id,user_id,' . Auth::id(), 'date_format:Y-m-d'],
            'date' => ['required', 'date_format:Y-m-d', Rule::unique('appointments')->where(fn ($query) => $query->where('user_id', auth()->user()->id))],
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
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param int $doctorId
     * @param string $date
     * @return Response
     */
    public function show(Request $request, int $doctorId, string $date)
    {
        $appointment = Appointment::where('user_id', $doctorId)->where('date', $date)->first();
        $times = Time::where('appointment_id', $appointment->id)->where('status', 0)->get();
        $user = User::where('id', $doctorId)->first();
        $doctor_id = $doctorId;

        return view('admin.appointment.show', compact('times', 'date', 'user', 'doctor_id'));
    }

    /**
     * Check appointment
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
     * Update appointment
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
