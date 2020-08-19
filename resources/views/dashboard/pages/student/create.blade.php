@extends('dashboard.layouts.maintemplate')

@section('title', 'Register Student')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Register Student</h1>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                {{-- --------- Check in Flash Message -------- --}}
                     
                @if(Session::get('success_message') && isset($last_tudent_info))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <h4><strong>{{ Session::get('success_message') }}</strong> </h4>
                        <p><b>Student Registration No:</b> {{$last_tudent_info->student_reg_no}} </p>
                        <p><b>Student Name:</b> {{$last_tudent_info->student_name}} </p>
                        <p><b>Email:</b> {{$last_tudent_info->email}} </p>
                        <p><b>Contact:</b> {{$last_tudent_info->contact_no}} </p>
                        <p><b>address:</b> {{$last_tudent_info->address}} </p>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                {{-- ---------------- X -------------------- --}}


                <form action="{{route('student.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label><b>Student Name</b></label>
                        <input type="text" name="student_name" class="form-control @error('student_name') is-invalid @enderror" value="{{old('student_name')}}" placeholder="Type Student Name">
                        @error('student_name')
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
                        <label><b>Date</b></label>
                        <input type="date" name="date" class="form-control @error('date') is-invalid @enderror" value="{{old('date')}}" placeholder="Contact No">
                        @error('date')
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
                        <label><b>Department</b></label>
                        <select name="department_id" class="form-control">
                                <option value="">--- Select Department ---</option>
                            @if (isset($departments))
                                @foreach ($departments as $department)
                                    <option value="{{$department->id}}">{{$department->department_name}}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('department_id')
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

