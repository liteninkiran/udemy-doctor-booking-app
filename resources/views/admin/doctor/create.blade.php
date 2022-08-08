@extends('admin.layouts.master')

@section('content')

<div class="page-header">

    <div class="row align-items-end">

        <!-- Header -->
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="ik ik-command bg-blue"></i>
                <div class="d-inline">
                    <h5>Doctors</h5>
                    <span>add doctor</span>
                </div>
            </div>
        </div>

        <!-- Breadcrumb -->
        <div class="col-lg-4">
            <nav class="breadcrumb-container" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="../index.html"><i class="ik ik-home"></i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="#">Doctor</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </nav>
        </div>

    </div>

</div>

<div class="row justify-content-center">

    <div class="col-lg-10">

        <!-- Alerts -->
        @if(Session::has('message'))
            <div class="alert bg-success alert-success text-white" role="alert">
                {{Session::get('message')}}
            </div>
        @endif

        <div class="card">

            <!-- Header -->
            <div class="card-header">
                <h3>Add doctor</h3>
            </div>

            <!-- Body -->
            <div class="card-body">

                <!-- Form -->
                <form class="forms-sample" action="{{route('doctor.store')}}" method="post" enctype="multipart/form-data">

                    <!-- Tokens -->
                    @csrf

                    <!-- Name / Email -->
                    <div class="row">

                        <!-- Full Name -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Full Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Doctor name" value="{{ old('name') }}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email address" value="{{ old('email') }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <!-- Password / Gender -->
                    <div class="row">

                        <!-- Password -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Doctor password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Gender -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Gender</label>
                                <select class="form-control @error('gender') is-invalid @enderror" name="gender">
                                    <option value="">Select...</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <!-- Education / Address -->
                    <div class="row">

                        <!-- Education -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Education</label>
                                <input type="text" name="education" class="form-control @error('education') is-invalid @enderror" placeholder="Highest degree" value="{{ old('education') }}">
                                @error('education')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Address</label>
                                <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Doctor address" value="{{ old('address') }}">
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <!-- Department / Phone Number -->
                    <div class="row">

                        <!-- Department -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Department</label>
                                <select name="department" class="form-control">
                                    <option value="">Select...</option>
                                    @foreach($departments as $d)
                                        <option value="{{$d->department}}">{{$d->department}}</option>
                                    @endforeach
                                </select>
                                @error('department')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Phone Number -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Phone Number</label>
                                <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" placeholder="Phone number" value="{{ old('phone_number') }}">
                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <!-- Photo / Role -->
                    <div class="row">

                        <!-- Photo -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" class="form-control file-upload-info @error('image') is-invalid @enderror" placeholder="Upload Image" name="image">
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Role -->
                        <div class="col-md-6">
                            <label>Role</label>
                            <select name="role_id" class="form-control @error('role_id') is-invalid @enderror">
                                <option value="">Select...</option>
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}">{{ ucfirst($role->name) }}</option>
                                @endforeach
                            </select>
                            @error('role_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>

                    <!-- About -->
                    <div class="form-group">
                        <label for="description">About</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="4" placeholder="Please provide some details about yourself" name="description">{{old('description')}}</textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Submit / Cancel -->
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>

                </form>

            </div>

        </div>

    </div>

</div>


@endsection
