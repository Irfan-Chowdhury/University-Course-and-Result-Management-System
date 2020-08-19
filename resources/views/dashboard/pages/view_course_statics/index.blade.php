@extends('dashboard.layouts.maintemplate')

@section('title', 'View Course Statics')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">View Course Statics</h1>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <form action="{{route('view_course_statics.show')}}" method="GET">
                    {{-- @csrf --}}

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

                    
                    <button type="submit" class="btn btn-primary">Save</button>
                    <br><br>

                    {{-- --------- Check in Flash Message -------- --}}
                        @include('dashboard.flashMessage.message')
                    {{-- ---------------- X -------------------- --}}
                </form>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <table class="table">
                    <thead class="thead-dark">
                      <tr class="text-center">
                        <th scope="col">SL</th>
                        <th scope="col">Course Code</th>
                        <th scope="col">Course Name</th>
                        <th scope="col">Semester</th>
                        <th scope="col">Assigned To</th>
                      </tr>
                    </thead>
                    <tbody class="table-secondary">
                        @if (isset($data))
                            @foreach ($data as $key=>$item)
                                <tr class="text-center">
                                    <td>{{$key+1}}</td>
                                    <td>{{$item->course_code}}</td>
                                    <td>{{$item->course_name}}</td>
                                    <td>{{$item->semester_name}}</td>
                                    <td>
                                        @if ($item->teacher_name!=NULL)
                                            {{$item->teacher_name}} 
                                        @else
                                            <b>Not Assigned Yet</b>
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

{{-- <tr class="text-center">
    <td>{{$key+1}}</td>
    <td>{{$item->course_code}}</td>
    <td>{{$item->course_name}}</td>
    <td>{{$item->semester_name}}</td>
    <td>
        @if ($item->teacher_name!=NULL)
            {{$item->teacher_name}} 
        @else
            <b>Not Assigned Yet</b>
        @endif

        @if($item->status==0)
            <b>Not Assigned Yet</b>
        @else
            <b>{{$item->teacher_name}}</b>
        @endif
    </td>
</tr> --}}