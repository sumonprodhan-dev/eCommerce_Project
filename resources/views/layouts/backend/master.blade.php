<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.backend.partials.head')
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        @include('layouts.backend.partials.sidebar')
        <!-- End Sidebar -->

        <div class="main-panel">

            @include('layouts.backend.partials.header')

            <div class="container">
                <div class="page-inner">
                    @yield('content')
                </div>
            </div>

            @include('layouts.backend.partials.footer') 
        </div>
    </div>
    <!--   Core JS Files   -->
    @include('layouts.backend.partials._script')
</body>

</html>