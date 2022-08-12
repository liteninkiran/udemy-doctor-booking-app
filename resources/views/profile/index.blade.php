@extends('layouts.app')

@section('content')
<div class="container">

    <!-- Alerts -->
    @if(Session::has('message'))
        <div class="alert alert-success">{{ Session::get('message') }}</div>
    @endif

    <div class="row">

        <!-- View Profile -->
        <div class="col-md-3">

            <!-- Card -->
            <div class="card">

                <!-- Header -->
                <div class="card-header">
                    User Profile
                </div>

                <!-- Body -->
                <div class="card-body">

                    <table>
                        <tr><th class="align-top">Name</th><td class="pb-3">{{ auth()->user()->name }}</td></tr>
                        <tr><th class="align-top">Email</th><td class="pb-3">{{ auth()->user()->email }}</td></tr>
                        <tr><th class="align-top">Address</th><td class="pb-3">{{ auth()->user()->address }}</td></tr>
                        <tr><th class="align-top pe-2">Telephone</th><td class="pb-3">{{ auth()->user()->phone_number }}</td></tr>
                        <tr><th class="align-top">Gender</th><td class="pb-3">{{ ucfirst(auth()->user()->gender) }}</td></tr>
                        <tr><th class="align-top">About</th><td class="pb-3">{{ auth()->user()->description }}</td></tr>
                    </table>

                </div>

            </div>

        </div>

        <!-- Update Profile -->
        <div class="col-md-6">

            <!-- Card -->
            <div class="card">

                <!-- Header -->
                <div class="card-header">
                    Update Profile
                </div>

                <!-- Body -->
                <div class="card-body">

                    <!-- Form -->
                    <form action="{{ route('profile.store') }}" method="post">
                        
                        <!-- Tokens -->
                        @csrf

                        <!-- Name -->
                        <div class="form-group mb-3">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ auth()->user()->name }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div class="form-group mb-3">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control" value="{{ auth()->user()->address }}">
                        </div>

                        <!-- Phone Number -->
                        <div class="form-group mb-3">
                            <label>Phone number</label>
                            <input type="text" name="phone_number" class="form-control" value="{{ auth()->user()->phone_number }}">
                        </div>

                        <!-- Gender -->
                        <div class="form-group mb-3">
                            <label>Gender</label>
                            <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                                <option value="">select gender</option>
                                <option value="male" @if(auth()->user()->gender === 'male') selected @endif >Male</option>
                                <option value="female" @if(auth()->user()->gender === 'female') selected @endif>Female</option>
                            </select>
                            @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- About -->
                        <div class="form-group mb-3">
                            <label>About</label>
                            <textarea name="description" class="form-control" rows="5">{{ auth()->user()->description }}</textarea>
                        </div>

                        <!-- Submit -->
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">
                                Update
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>

        <!-- Update Profile Picture -->
        <div class="col-md-3">

            <!-- Card -->
            <div class="card">

                <!-- Header -->
                <div class="card-header">
                    Update Profile Picture
                </div>

                <!-- Form -->
                <form action="{{ route('profile.pic') }}" method="post" enctype="multipart/form-data">

                    <!-- Tokens -->
                    @csrf

                    <!-- Body -->
                    <div class="card-body">

                        <!-- User Image -->
                        @if(!auth()->user()->image)
                            <img src="{{asset('images')}}/default-profile.png" width="120">
                        @else 
                            <img src="/profile/{{ auth()->user()->image }}" width="120">
                        @endif

                        <br>

                        <!-- Upload New Image -->
                        <input type="file" name="file" class="form-control" required="">

                        <br>

                        <!-- Alerts -->
                        @error('file')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <!-- Submit -->
                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>
@endsection
