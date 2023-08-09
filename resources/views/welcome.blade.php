@extends('layouts.app')

@section('pageTitle', $pageTitle)

@section('content')
    <div class="md:hidden">
        <!-- small version -->
        <h1 class="text-2xl font-semibold">{{ $pageTitle }}</h1>

        Installe un fond d'écran inspirant sur ton téléphone.
        <img src="/images/welcome-mobile.jpg" class="mx-auto">

    </div>

    <div class="hidden md:block">
        <!-- other one -->
        <div class="flex items-center max-w-screen-xl mx-auto px-4 xl:py-20">
            <div class="flex md:p-4 mx-auto">
                <div class="text-center pt-8 md:flex-shrink-0 md:flex-grow-0 md:w-1/2 md:text-left md:pt-8">
                    <h1 class="text-2xl md:text-4xl font-semibold">{{ $pageTitle }}</h1>
                    <strong>Le principe :</strong>
                    <ul>
                        <li>A votre rythme (toutes les heures/les jours/les semaines/les ans/...)</li>
                        <li>Obtenez un fond d'écran inspirant pour votre téléphone</li>
                    </ul>
                </div>
                <div class="md:block md:flex-shrink-0 md:flex-grow-0 md:w-1/2">
                    <img src="/images/welcome-default.jpg">
                </div>
            </div>
        </div>
    </div>

    <div class="px-4 mx-auto text-{{ $color }}-900">
        <strong>Comment faire</strong>
        <ul>
            <li>sous iOS : <a href="https://www.icloud.com/shortcuts/841f14de93454f0eb3df6b433b41f9f7">lien raccourci</a>
            </li>
            <li>sous android (bientot)>
            <li>sous windows (bientot)>
            <li>sous mac (bientot)>
            <li>sous linux (bientot)>
        </ul>
    </div>
@endsection
