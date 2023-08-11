@extends('layouts.app')

@section('pageTitle', $pageTitle)

@section('content')
    <div class="md:hidden bg-{{ $color }}-900 rounded-lg p-2">
        <!-- small version -->
        <h1 class="text-2xl font-semibold">{{ $pageTitle }}</h1>

        Installe un fond d'écran inspirant sur ton téléphone.

        <img src="/images/welcome.jpg" class="rounded mx-auto">

        @include('partials/comment')
    </div>

    <div class="hidden md:block bg-{{ $color }}-900 rounded-lg">
        <!-- other one -->
        <div class="flex items-center max-w-screen-xl mx-auto px-4 xl:py-20">
            <div class="flex mx-auto">
                <div class="text-center pt-2 md:flex-shrink-0 md:flex-grow-0 md:w-1/2 md:text-left">
                    <h1 class="text-2xl md:text-4xl font-semibold">{{ $pageTitle }}</h1>

                    @include('partials/comment')

                </div>
                <div class="md:block md:flex-shrink-0 md:flex-grow-0 md:w-1/2 px-4">
                    <img class="rounded-lg" src="/images/welcome.jpg">
                </div>
            </div>
        </div>
    </div>

    <div class="px-4 mx-auto">

    </div>
@endsection
