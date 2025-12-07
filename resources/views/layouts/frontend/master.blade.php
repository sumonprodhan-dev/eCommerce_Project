@include('layouts.frontend.partial.head')

<body>
    <!--[if lte IE 9]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->

    <!-- header area start -->
    @include('layouts.frontend.partial.header')
    <!-- header area end -->


     @yield('content')





    <!-- scroll to top -->
    <div class="scroll-top not-visible">
        <i class="fa fa-angle-up"></i>
    </div> <!-- /End Scroll to Top -->

    <!-- footer area start -->
    @include('layouts.frontend.partial.footer')
    <!-- footer area end -->

  

    {{-- script file --}}
    @include('layouts.frontend.partial.script')
</body>

</html>
