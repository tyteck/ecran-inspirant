@extends('layouts.app')

@section('pageTitle', 'Page non trouvée')

@section('content')

    <x-navigation :colorName="$colorName" activeRoute="index" />

    <div class="md:hidden bg-{{ $colorName }}-900 rounded-lg px-2 py-20 text-center">
        <!-- small version -->
        <h1 class="text-2xl font-semibold text-center">Page non trouvée</h1>

        {{ $message }}
    </div>

    <div class="hidden md:block bg-{{ $colorName }}-900 rounded-lg">
        <!-- other one -->
        <div class="max-w-screen-xl mx-auto px-4 xl:py-20 text-center pt-2">
            <h1 class="text-2xl font-semibold text-center">Page non trouvée</h1>

            {{ $message }}
        </div>
    </div>

@endsection
