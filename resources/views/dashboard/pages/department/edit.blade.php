@extends('dashboard.layouts.maintemplate')

@section('title', 'Department Edit')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Department Edit</h1>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <form action="{{route('department.update',$department->id)}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label><b>Department Code</b></label>
                        <input type="text" name="department_code" class="form-control @error('class_id') is-invalid @enderror" value="{{$department->department_code}}">
                        @error('department_code')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror 
                    </div>

                    <div class="form-group">
                        <label><b>Department Name</b></label>
                        <input type="text" name="department_name" class="form-control" value="{{$department->department_name}}">
                        @error('department_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror 
                    </div>

                    
                    <button type="submit" class="btn btn-primary">Update</button>

                    {{-- --------- Check in Flash Message -------- --}}
                        @include('dashboard.flashMessage.message')
                    {{-- ---------------- X -------------------- --}}
                </form>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>

@endsection