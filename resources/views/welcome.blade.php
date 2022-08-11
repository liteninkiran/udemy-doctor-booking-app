@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row">

        <!-- Banner Image -->
        <div class="col-md-6">
            <img src="/banner/banner.jpg" class="img-fluid" style="border:1px solid #ccc;">
        </div>

        <!-- About -->
        <div class="col-md-6">

            <!-- Header -->
            <h2>Create Account | Book Appointment</h2>

            <!-- Blurb -->
            <p>
                Doctor Booking App was established in 2022 to fill the void in the booking system market that saw a lack of bespoke solutions. 
                We don't know about you, but we've never really liked the phrase 'one size fits all'. How can it? Every business is completely 
                different in the way it functions. This is why we believe that booking solutions which are delivered to the customers exact 
                specification is the best practise.
            </p>
            <p>
                Our onsite client workshops prior to development ensure that all processes and workflows are mapped out before the booking 
                system customisations begin.
            </p>

            <!-- Login / Register -->
            <div class="mt-5">
               <a href="{{ url('/register') }}"> <button class="btn btn-success">Register as Patient</button></a>
                <a href="{{ url('/login') }}"><button class="btn btn-secondary">Login</button></a>
            </div>

        </div>

    </div>

    <hr class="my-5">

    <!-- Search Doctors -->
    <form action="{{ url('/') }}" method="GET" class="mb-5">
        <div class="card">
            <div class="card-body">
                <div class="card-header">Find Doctors</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <input type="text" name="date" class="form-control" id="datepicker">
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-primary" type="submit">Find Doctors</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Display Doctors -->
    <div class="card">
        <div class="card-body">
            <div class="card-header">Doctors</div>
            <div class="card-body">

                <!-- Table -->
                <table class="table table-striped">

                    <!-- Table Header -->
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Book</th>
                        </tr>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                       @forelse($doctors as $doctor)
                            <tr>
                                <td><img src="{{asset('images')}}/{{$doctor->image}}" width="50px" style="border-radius: 50%;"></td>
                                <td class="align-middle">{{ $doctor->name }}</td>
                                <td class="align-middle">{{ $doctor->department->department }}</td>
                                <td class="align-middle"><a href="{{ route('appointment.create', [$doctor->user_id, $doctor->date]) }}"><button class="btn btn-success">Book Appointment</button></a></td>
                            </tr>
                        @empty
                            <td>No doctors available today</td>
                        @endforelse
                    </tbody>

                </table>
                
            </div>

        </div>
        
    </div>

</div>

@endsection
