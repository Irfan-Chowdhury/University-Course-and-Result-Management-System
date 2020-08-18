@extends('dashboard.layouts.maintemplate')

@section('title', 'Course Assign To Teacher')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Course Assign To Teacher</h1>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                {{-- --------- Check in Flash Message -------- --}}
                        @include('dashboard.flashMessage.message')
                {{-- ---------------- X -------------------- --}}


                <form action="{{route('course_assign_to_teacher.store')}}" method="post">
                    @csrf

                    <div class="form-group">
                        <label><b>Department</b></label>
                        <select id="departmentId" name="department_id" class="form-control @error('department_id') is-invalid @enderror">
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
                        <label><b>Teacher</b></label>
                        <select id="teacherId" name="teacher_id" class="form-control @error('department_id') is-invalid @enderror">
                            <option>--- Select Teacher ---</option>
                        </select>
                        @error('teacher_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror 
                    </div>

                

                    <div id="creditAndCourseInfo"> <!--Ajax start-->
                            <div class="form-group">
                                <label><b>Credit To Be Taken</b></label>
                                <input type="text" name="credit_to_be_taken" class="form-control" readonly value="0">
                            </div>
                            
                            <div class="form-group">
                                <label><b>Remaining Credit</b></label>
                                <input type="text" name="credit_to_be_taken" class="form-control" readonly value="0">
                            </div>

                            <div class="form-group">
                                <label><b>Course Code</b></label>
                                <select name="course_id" class="form-control"> <!--id="courseId" এটা course-name_and_credit-info.blade.php দেয়া হইছে, এখানে কোন কাজ নাই, কারণ নতুন ভাবে ওখানেই লোড হইছে-->
                                        <option value="">--- Select Course Code ---</option>
                                </select>
                                @error('course_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror 
                            </div>
                    </div> <!--Ajax End-->



                    <div id="courseNameAndCreditInfo"> <!--Ajax start-->
                            <div class="form-group">
                                <label><b>Course Name</b></label>
                                <input type="text" class="form-control" readonly>
                            </div>
                            
                            <div class="form-group">
                                <label><b>Course Credit</b></label>
                                <input type="text" class="form-control" readonly>
                            </div>
                    </div> <!--Ajax End-->
                    
                    <button type="submit"  id="creditCheck" class="btn btn-primary">Save</button>
                    <br><br>
                </form>

            </div>
            <div class="col-md-3"></div>
        </div>
    </div>



<script>

    //after selecting Department then Teacher will be loaded
    $('#departmentId').change(function() 
    {
        var departmentId = $(this).val();
        if (departmentId) 
        {

            $.get("{{route('department-wise-teacher-list')}}",{department_id:departmentId}, function (data) 
            {
                console.log('ok');
                $('#teacherId').empty().html(data); //
            });
        }
        else{
            $('#teacherId').empty().html('<option>--Select Teacher--</option>');
        }
    })
    
    //after selecting Teacher then credit info & Course Code dropdown will be loaded
    $('#teacherId').change(function() 
    {
        var departmentId = $('#departmentId').val();
        var teacherId = $(this).val();

        if (departmentId && teacherId) 
        {
            $.get("{{route('teacher-wise-credit_and_course-info')}}",{department_id:departmentId,teacher_id:teacherId}, function (data) 
            {
                console.log('ok');
                $('#creditAndCourseInfo').empty().html(data); //
            });
        }
    })

    
    //after selecting Course Code then Course name and Credit info will be loaded || check 'teacher-wise-credit_and_course-info.blade.php'
    //Check - course-name_and_credit-info.blade.php


</script>


@endsection

