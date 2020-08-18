@extends('dashboard.layouts.maintemplate')

@section('title', 'Department Setup')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Department Setup</h1>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <form action="{{route('department.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label><b>Department Code</b></label>
                        <input type="text" name="department_code" class="form-control @error('class_id') is-invalid @enderror" value="{{old('department_code')}}" placeholder="Type Department Code">
                        @error('department_code')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror 
                    </div>

                    <div class="form-group">
                        <label><b>Department Name</b></label>
                        <input type="text" name="department_name" class="form-control" value="{{old('department_name')}}" placeholder="Type Department Name">
                        @error('department_name')
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
                        <th scope="col">Department Code</th>
                        <th scope="col">Department Name</th>
                        <th scope="col" colspan="2">Action</th>
                      </tr>
                    </thead>
                    <tbody class="table-secondary">
                        @foreach ($departments as $key=>$department)
                            <tr class="text-center">
                                <td scope="row">{{$key+1}}</th>
                                <td class="text-dark">{{$department->department_code}}</td>
                                <td class="text-dark">{{$department->department_name}}</td>
                                <td>
                                    <a href="{{route('department.edit',$department->id)}}" class="btn btn-success">Edit</a>
                                    <a href="{{route('department.delete',$department->id)}}" class="btn btn-danger" onclick="return confirm('Are You Sure to delete ?')">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
            <div class="col-md-1"></div>
        </div>  
    </div>
@endsection

