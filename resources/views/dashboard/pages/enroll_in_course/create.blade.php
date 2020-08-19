@extends('dashboard.layouts.maintemplate')

@section('title', 'Enroll In a Course')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Enroll In a Course</h1>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                {{-- --------- Check in Flash Message -------- --}}
                        @include('dashboard.flashMessage.message')
                {{-- ---------------- X -------------------- --}}


                <form action="{{route('enroll_in_course.store')}}" method="post">
                    @csrf

                    <div class="form-group">
                        <label><b>Student Reg. No</b></label>
                        <select name="student_id" id="studentId" class="form-control">
                                <option value="">--- Select Student ID ---</option>
                            @foreach ($students as $student)
                                <option value="{{$student->id}}">{{$student->student_reg_no}}</option>
                            @endforeach
                          </select>
                        @error('student_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror 
                    </div>

                    <div id="studentDetails">
                        <div class="form-group">
                            <label><b>Name</b></label>
                            <input type="text" name="studentName" class="form-control" readonly>
                        </div>
                        
                        <div class="form-group">
                            <label><b>Email</b></label>
                            <input type="text" name="email" class="form-control" readonly>
                        </div>
                        
                        <div class="form-group">
                            <label><b>Department</b></label>
                            <input type="text" name="departmentId" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label><b>Select Course</b></label>
                            <select name="course_id" id="courseId" class="form-control">
                                    <option value="">--- Select Course ---</option>
                            </select>
                            @error('course_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror 
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Save</button>
                    <br><br>
                </form>

            </div>
            <div class="col-md-3"></div>
        </div>
    </div>



<script>
        //after selecting Department then Teacher will be loaded
    $('#studentId').change(function() 
    {
        var studentId = $(this).val();
        // var studentId = $('#studentId').val();
        if (studentId) 
        {
            console.log(studentId);

            $.get("{{route('student-wise-info')}}",{student_id:studentId}, function (data) 
            {
                console.log('ok');
                $('#studentDetails').empty().html(data); //
            });
        }
    })
</script>

@endsection

