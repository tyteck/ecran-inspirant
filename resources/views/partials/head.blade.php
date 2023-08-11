<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('pageTitle') - Ecran Inspirant</title>
    <meta name="description" content="Des fonds d'écran inspirants">
    <meta name="keywords" content="Inspirantion, fond d'écran, raccourcis, iphone">
    <meta name="author" content="Frederick Tyteca">

    <!--Favicon-->
    <link rel="icon" type="image/png" href="/favicon.png" />

    @vite(['resources/js/app.js'])

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>