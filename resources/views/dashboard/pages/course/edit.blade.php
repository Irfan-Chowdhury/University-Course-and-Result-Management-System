@extends('dashboard.layouts.maintemplate')

@section('title', 'Course Setup')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Course Edit</h1>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                {{-- --------- Check in Flash Message -------- --}}
                        @include('dashboard.flashMessage.message')
                {{-- ---------------- X -------------------- --}}


                <form action="{{route('course.update',$course->id)}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label><b>Course Code</b></label>
                        <input type="text" name="course_code" class="form-control @error('course_code') is-invalid @enderror" value="{{$course->course_code}}" placeholder="Type Department Code">
                        @error('course_code')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror 
                    </div>

                    <div class="form-group">
                        <label><b>Course Name</b></label>
                        <input type="text" name="course_name" class="form-control @error('course_name') is-invalid @enderror" value="{{$course->course_name}}" placeholder="Type Department Name">
                        @error('course_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror 
                    </div>
                    
                    <div class="form-group">
                        <label><b>Course Credit</b></label>
                        <input type="text" name="credit" class="form-control @error('credit') is-invalid @enderror" value="{{$course->credit}}" placeholder="Course Credit">
                        @error('credit')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror 
                    </div>
                    
                    <div class="form-group">
                        <label><b>Course Description</b></label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror"  id="" rows="3">{{$course->description}}</textarea>
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror 
                    </div>
                    
                    <div class="form-group">
                        <label><b>Department</b></label>
                        <select name="department_id" class="form-control">
                                <option value="">--- Select Department ---</option>
                            @foreach ($departments as $department)
                                <option value="{{$department->id}}" {{ $department->id == $course->department_id ? 'selected="selected"' : '' }}>{{$department->department_name}}</option>
                            @endforeach
                          </select>
                        @error('department_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror 
                    </div>

                   
                    <div class="form-group">
                        <label><b>Semester</b></label>
                        <select name="semester_id" class="form-control">
                                <option value="">--- Select Semester ---</option>
                            @foreach ($semesters as $semester)
                                <option value="{{$semester->id}}" {{ $semester->id == $course->semester_id ? 'selected="selected"' : '' }}>{{$semester->semester_name}}</option>
                            @endforeach
                          </select>
                        @error('semester_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror 
                    </div>

                    
                    <button type="submit" class="btn btn-primary">Update</button>
                    <br><br>
                </form>

            </div>
            <div class="col-md-3"></div>
        </div>
    </div>

@endsection

