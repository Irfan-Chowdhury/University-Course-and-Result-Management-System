@extends('dashboard.layouts.maintemplate')

@section('title', 'Unallocate All Classrooms')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Unallocate All Classrooms</h1>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <form action="{{route('unallocate')}}" method="POST">
                    @csrf

                    <button type="submit" class="btn btn-primary" onclick="return confirm('Are You Sure ?')">Unallocate All Classrooms</button>
                    <br><br>

                    {{-- --------- Check in Flash Message -------- --}}
                        @include('dashboard.flashMessage.message')
                    {{-- ---------------- X -------------------- --}}
                </form>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>

@endsection

