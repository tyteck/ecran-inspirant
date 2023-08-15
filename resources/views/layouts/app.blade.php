<!DOCTYPE html>
<html lang="en">

@include('partials.head')

<body class="max-w-screen-xl antialiased bg-gray-50 text-{{ $color }}-50 mx-auto p-1 md:p-4">

    @include ('partials.flash')

    @yield('content')

    @include ('partials.footer')

</body>

</html>
