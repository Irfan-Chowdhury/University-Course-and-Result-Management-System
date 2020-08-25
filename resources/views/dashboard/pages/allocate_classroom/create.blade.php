@extends('dashboard.layouts.maintemplate')

@section('title', 'Allocate Classroom')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Allocate Classroom</h1>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                {{-- --------- Check in Flash Message -------- --}}
                        @include('dashboard.flashMessage.message')
                {{-- ---------------- X -------------------- --}}


                <form action="{{route('allocate_classroom.store')}}" method="POST">
                    @csrf

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
                        <label><b>Course</b></label>
                        <select name="course_id" class="form-control">
                                <option value="">--- Select Course ---</option>
                            @foreach ($courses as $course)
                                <option value="{{$course->id}}">{{$course->course_name}}</option>
                            @endforeach
                          </select>
                        @error('course_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror 
                    </div>
                 
                 
                    <div class="form-group">
                        <label><b>Room No</b></label>
                        <select name="room_id" class="form-control">
                                <option value="">--- Select Room ---</option>
                            @foreach ($rooms as $room)
                                <option value="{{$room->id}}">{{$room->room_no}}</option>
                            @endforeach
                          </select>
                        @error('room_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror 
                    </div>
                  
                  
                    <div class="form-group">
                        <label><b>Day</b></label>
                        <select name="day" class="form-control">
                                <option value="">--- Select Day ---</option>
                                <option value="Sat">Saterday</option>                                
                                <option value="Sun">Sunday</option>                                
                                <option value="Mon">Monday</option>                                
                                <option value="Tue">Tuesday</option>                                
                                <option value="Wed">Wedday</option>                                
                                <option value="Thu">Thursday</option>                                
                                <option value="Fri">Friday</option>                                
                          </select>
                        @error('day')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror 
                    </div>
                    
                    
                    <div class="form-group">
                        <label><b>From</b></label>
                        <input type="time" name="from" class="form-control" value="{{old('from')}}">
                        @error('from')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror 
                    </div>
                    
                    
                    <div class="form-group">
                        <label><b>To</b></label>
                        <input type="time" name="to" class="form-control" value="{{old('to')}}">
                        @error('to')
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

