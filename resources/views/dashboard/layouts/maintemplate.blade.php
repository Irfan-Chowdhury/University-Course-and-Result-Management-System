<!DOCTYPE html>
<html lang="en">
<head>
    @include('dashboard.includes.header')
</head>

<body id="page-top">
    <div id="wrapper">
            
            @include('dashboard.includes.sidebar')

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
                <!-- Main Content -->
                <div id="content">

                    @include('dashboard.includes.navbar')
        {{-- ==================================================== --}}
                             @yield('content')
        {{-- ==================================================== --}}
    
                </div>
                
                <!-- End of Main Content -->    
                @include('dashboard.includes.footer')

            </div>
            <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    
        @include('dashboard.includes.script')
</body>
</html>