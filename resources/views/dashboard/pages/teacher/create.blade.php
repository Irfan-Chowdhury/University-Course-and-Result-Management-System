@extends('dashboard.layouts.maintemplate')

@section('title', 'Teacher Create')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Teacher Create</h1>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                {{-- --------- Check in Flash Message -------- --}}
                        @include('dashboard.flashMessage.message')
                {{-- ---------------- X -------------------- --}}


                <form action="{{route('teacher.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label><b>Teacher Name</b></label>
                        <input type="text" name="teacher_name" class="form-control @error('teacher_name') is-invalid @enderror" value="{{old('teacher_name')}}" placeholder="Type Teacher Name">
                        @error('teacher_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror 
                    </div>

                    <div class="form-group">
                        <label><b>Address</b></label>
                        <textarea name="address" class="form-control @error('address') is-invalid @enderror"  id="" rows="3">{{old('address')}}</textarea>
                        @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror 
                    </div>

                    <div class="form-group">
                        <label><b>Email</b></label>
                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" placeholder="Type Email">
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror 
                    </div>
                    
                    <div class="form-group">
                        <label><b>Contact No</b></label>
                        <input type="text" name="contact_no" class="form-control @error('contact_no') is-invalid @enderror" value="{{old('contact_no')}}" placeholder="Contact No">
                        @error('contact_no')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror 
                    </div>
                    
                    <div class="form-group">
                        <label><b>Designation</b></label>
                        <select name="designation" class="form-control">
                                <option value="">--- Select Designation ---</option>
                                <option value="Chairman">Chairman</option>
                                <option value="Professor">Professor</option>
                                <option value="Associate_Professor">Associate Professor</option>
                                <option value="Assistant_Teacher">Assistant Teacher</option>
                                <option value="Lecturer">Lecturer</option>
                                <option value="Teacher_Assistant">Teacher Assistant</option>
                          </select>
                        @error('designation')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror 
                    </div>

                    
                    <div class="form-group">
                        <label><b>Department</b></label>
                        <select name="department_id" class="form-control">
                                <option value="">--- Select Department ---</option>
                            @foreach ($departments as $department)
                                <option value="{{$department->id}}">{{$department->department_name}}</option>
                            @endforeach
                          </select>
                        @error('department_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror 
                    </div>

                   
                    <div class="form-group">
                        <label><b>Credit To Be Taken</b></label>
                        <input type="number" min="0" name="credit_to_be_taken" class="form-control @error('credit_to_be_taken') is-invalid @enderror" value="{{old('credit_to_be_taken')}}" placeholder="Credit Taken">
                        @error('credit_to_be_taken')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror 
                    </div>

                    
                    <button type="submit" class="btn btn-primary">Save</button>
                    <br><br>
                </form>

            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
@endsection

