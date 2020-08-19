@extends('dashboard.layouts.maintemplate')

@section('title', 'Student Result Save')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Student Result Save</h1>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                {{-- --------- Check in Flash Message -------- --}}
                        @include('dashboard.flashMessage.message')
                {{-- ---------------- X -------------------- --}}


                <form action="{{route('result.store')}}" method="post">
                    @csrf

                    <div class="form-group">
                        <label><b>Student Reg. No</b></label>
                        <select name="student_id" id="studentId" class="form-control" onchange="window.location.href=this.value;">
                                <option value="">--- Select Student ID ---</option>
                                
                                @if (isset($single_student))
                                    <option value="{{$single_student->id}}" selected >{{$single_student->student_reg_no}}</option>
                                @endif

                                @foreach ($students as $student)   
                                    <option value="{{route('data_by_student.show',$student->id)}}">{{$student->student_reg_no}}</option>  
                                                            
                                    {{-- @if (isset($single_student))
                                        <option value="{{$student->id}}" {{$student->id==$single_student->id ? "selected":" "}} >{{$student->student_reg_no}}</option>
                                    {{-- @else
                                        <option value="{{route('data_by_student.show',$student->id)}}">{{$student->student_reg_no}}</option> --}}
                                    {{--@endif --}}
                                @endforeach
                          </select>
                        @error('student_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror 
                    </div>

                    <div class="form-group">
                        <label><b>Name</b></label>
                        <input type="text" name="studentName" class="form-control" readonly @if(isset($single_student)) value="{{$single_student->student_name}}" @endif>
                    </div>
                    
                    <div class="form-group">
                        <label><b>Email</b></label>
                        <input type="text" name="email" class="form-control" readonly @if(isset($single_student)) value="{{$single_student->email}}" @endif>
                    </div>
                    
                    <div class="form-group">
                        <label><b>Department</b></label>
                        <input type="text" name="departmentId" class="form-control" readonly @if(isset($department)) value="{{$department->department_name}}" @endif>
                    </div>

                    <div class="form-group">
                        <label><b>Select Course</b></label>
                        <select name="course_id" id="courseId" class="form-control">
                                    <option value="">--- Select Course ---</option>
                            @if(isset($courses))
                                @foreach ($courses as $course)
                                    <option value="{{$course->id}}">{{$course->course_name}}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('course_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror 
                    </div>
                    
                    
                    <div class="form-group">
                        <label><b>Select Grade Letter</b></label>
                        <select name="grade" id="courseId" class="form-control">
                                <option value="">--- Select Course ---</option>
                                <option value="A+">A+</option>
                                <option value="A">A</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B">B</option>
                                <option value="B-">B-</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="F">F</option>
                          </select>
                        @error('grade')
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

