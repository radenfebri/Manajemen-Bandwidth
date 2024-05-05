<html lang="en">

@include('dashboard.head')

<body>
        @include('sweetalert::alert')
        
        
        <script src="{{ asset('template') }}/dist/js/demo-theme.min.js?1684106062"></script>
        <div class="page">
                
                @include('dashboard.header')
                
                
                @include('dashboard.menu')
                
                <div class="page-wrapper">
                        <!-- Page header -->
                        
                        
                        @yield('content')
                        
                        
                </div>
                <!--  -->
        </div>
</div>
</div>

@include('dashboard.footer')

</div>
</div>

@include('dashboard.script')
</body>
</html>