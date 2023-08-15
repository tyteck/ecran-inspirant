@extends('layouts.app')

@section('pageTitle', $pageTitle)

@section('content')
    <div x-data="{
        preset: '',
        getUrl: 'https://get.ecran-inspirant.fr/',
    }">
        <x-navigation :color="$color" activeRoute="help" />

        <div class="md:hidden bg-{{ $color }}-900 rounded-lg p-2">
            <!-- small version -->
            <h1 class="text-2xl font-semibold">{{ $pageTitle }}</h1>

            @include('partials.urlHelper')
        </div>

        <div class="hidden md:block bg-{{ $color }}-900 rounded-lg">
            <!-- other one -->
            <div class="max-w-screen-xl mx-auto px-4 xl:py-20">
                <div class="text-center pt-2 md:flex-shrink-0 md:flex-grow-0 md:w-1/2 md:text-left">
                    <h1 class="text-2xl md:text-4xl font-semibold">{{ $pageTitle }}</h1>

                    @include('partials.urlHelper')
                </div>
            </div>
        </div>
    </div>
@endsection
