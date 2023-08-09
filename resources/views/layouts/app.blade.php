<!DOCTYPE html>
<html lang="en">

@include('partials.head')

<body class="max-w-screen-xl antialiased bg-{{ $color }}-900 text-{{ $color }}-100 mx-auto p-5">

    @include ('partials.flash')

    @yield('content')

    @include ('partials.footer')

</body>

@if (App::environment('testing'))
    @include ('partials.testing')
@endif

</html>
