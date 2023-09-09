<!DOCTYPE html>
<html lang="en">
<style>
    html {
        visibility: hidden;
        opacity: 0;
    }
</style>
@include('partials.head')

<body class="max-w-screen-xl antialiased bg-gray-50 text-{{ $colorName }}-50 mx-auto p-1 md:p-4">

    @include ('partials.flash')

    @yield('content')

    @include ('partials.footer')

</body>

<script>
    let domReady = (cb) => {
        document.readyState === 'interactive' || document.readyState === 'complete' ?
            cb() :
            document.addEventListener('DOMContentLoaded', cb);
    };

    domReady(() => {
        // Display body when DOM is loaded
        document.body.style.visibility = 'visible';
    });
</script>

</html>
