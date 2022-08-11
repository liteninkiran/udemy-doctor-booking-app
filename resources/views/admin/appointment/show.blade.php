@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        @if($times)

            <!-- Doctor Card -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-center">Doctor Information</h4>
                        <img  src="{{ asset('images') }}/{ {$user->image }}" width="100px" style="border-radius: 50%;" >
                        <br>
                    <p class="lead"> Name: {{ $user->name }}</p>
                    <p class="lead"> Degree: {{ $user->education }}</p>
                    <p class="lead"> Department: {{ $user->department->department }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-9">

                <!-- Alerts -->
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                @endforeach

                @if(Session::has('message'))
                    <div class="alert alert-success">
                        {{ Session::get('message') }}
                    </div>
                @endif

                @if(Session::has('errmessage'))
                    <div class="alert alert-danger">
                        {{ Session::get('errmessage') }}
                    </div>
                @endif

                <!-- Booking Form -->
                <form action="{{ route('booking.appointment') }}" method="post">

                    <!-- Tokens -->
                    @csrf

                    <!-- Card -->
                    <div class="card">

                        <!-- Card Header -->
                        <div class="card-header lead">
                            {{ $date }}
                        </div>

                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="row">
                                @foreach($times as $time)
                                    <div class="col-md-3">
                                        <label class="btn btn-outline-primary">
                                            <input type="radio" name="time" value="{{ $time->time }}">
                                            <span>{{ $time->time }}</span>
                                        </label>
                                    </div>
                                    <input type="hidden" name="doctorId" value="{{ $time->appointment->doctor->id }}">
                                    <input type="hidden" name="appointmentId" value="{{ $time->appointment_id }}">
                                    <input type="hidden" name="date" value="{{ $date }}">
                                @endforeach
                            </div>
                        </div>

                    </div>

                    <!-- Card Footer -->
                    <div class="card-footer">
                        @if(Auth::check())
                            <button type="submit" class="btn btn-success" style="width: 100%;">Book Appointment</button>
                        @else
                            <p>Please login to make an appointment</p>
                            <a href="/register">Register</a>
                            <a href="/login">Login</a>
                        @endif
                </div>

                </form>

            </div>

        @else
            <p>No times</p>
        @endif

    </div>

</div>
@endsection
