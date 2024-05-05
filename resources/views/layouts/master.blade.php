<!DOCTYPE html>
<html lang="en">

@include('layouts.head')

<body class="d-flex flex-column">

    @include('sweetalert::alert')


    @yield('content')

</body>

@include('layouts.script')

</html>
