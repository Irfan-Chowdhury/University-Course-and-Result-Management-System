@extends('dashboard.layouts.maintemplate')

@section('title', 'View Student Result')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">View Student Result</h1>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                {{-- --------- Check in Flash Message -------- --}}
                        @include('dashboard.flashMessage.message')
                {{-- ---------------- X -------------------- --}}

                    <div class="form-group row">
                        <div class="col-md-2">
                            <label><b>Student Reg. No</b></label>
                        </div>
                        <div class="col-md-10">
                            <select name="student_id" id="studentId" class="form-control" onchange="window.location.href=this.value;">
                                <option value="">--- Select Student ID ---</option>
                                
                                @if (isset($single_student))
                                    <option value="{{$single_student->id}}" selected >{{$single_student->student_reg_no}}</option>
                                @endif

                                @foreach ($students as $student)                                           
                                        @if(isset($single_student) && ($student->id == $single_student->id))
                                             @php continue @endphp
                                        @else
                                            <option value="{{route('view_result.show',$student->id)}}">{{$student->student_reg_no}}</option>
                                        @endif  
                                @endforeach
                            </select>
                        </div>
                        @error('student_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror 
                    </div>

                    <div class="form-group row">
                        <div class="col-md-2">
                            <label><b>Name</b></label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" name="studentName" class="form-control" readonly @if(isset($single_student)) value="{{$single_student->student_name}}" @endif>
                        </div>
                    </div>

                    
                    <div class="form-group row">
                        <div class="col-md-2">
                            <label><b>Email</b></label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" name="email" class="form-control" readonly @if(isset($single_student)) value="{{$single_student->email}}" @endif>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-md-2">
                            <label><b>Department</b></label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" name="departmentId" class="form-control" readonly @if(isset($department)) value="{{$department->department_name}}" @endif>
                        </div>
                    </div>
                    
                    <br><br>
            </div>
        </div>
    </div>


    <div class="container mt-5">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <table class="table">
                    <thead class="thead-dark">
                      <tr class="text-center">
                        <th>SL</th>
                        <th>Course Code</th>
                        <th>Course Name</th>
                        <th>Grade</th>
                      </tr>
                    </thead>
                    <tbody class="table-secondary">
                        @if (isset($view_courses_result))
                            @foreach($view_courses_result as $key => $item)
                                <tr class="text-center">
                                    <td>{{$key+1}}</td>
                                    <td>{{$item->course_code}}</td>
                                    <td>{{$item->course_name}}</td>
                                    <td> 
                                        @if ($item->grade!=NULL)
                                            {{$item->grade}}
                                        @else
                                            <span class="text-danger">Not Graded Yet</span>
                                        @endif 
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                  </table>
            </div>
            <div class="col-md-1"></div>
        </div>  
    </div>
@endsection

