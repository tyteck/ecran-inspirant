<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('pageTitle') - Ecran Inspirant</title>
    <meta name="description" content="{{ $description }}">
    <meta name="keywords" content="Inspiration, fond d'écran, raccourcis, iphone, wallpaper">
    <meta name="author" content="Frederick Tyteca">

    <!--Favicon-->
    <link rel="icon" type="image/png" href="/favicon.png" />

    <meta property="og:title" content="Ecran Inspirant" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://ecran-inspirant.fr" />
    <meta property="og:image" content="https://ecran-inspirant.fr/images/welcome.jpg" />
    <meta property="og:description" content="{{ $description }}" />
    <meta property="og:locale" content="fr_FR" />

    @vite(['resources/js/app.js'])

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
