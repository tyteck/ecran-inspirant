@extends('layouts.app')

@section('pageTitle', $pageTitle)

@section('content')
    <div x-data="{
        baseUrl: '{{ route('createPicture') }}/',
        urlToDisplay: '{{ route('createPicture') }}/',
        get displayUrl() {
            return this.urlToDisplay
        },
        imageWidth: null,
        imageHeight: null,
        imagePreset: null,
        setHeight(event) {
            this.imageHeight = event.target.value
            this.refreshUrl()
    
        },
        setWidth(event) {
            this.imageWidth = event.target.value
            this.refreshUrl()
        },
        setPreset(event) {
            this.imagePreset = event.target.value
            this.imageWidth = null
            this.imageHeight = null
            this.refreshUrl()
        },
        refreshUrl() {
            if (this.isValid(this.imageWidth) && this.isValid(this.imageHeight)) {
                this.urlToDisplay = this.baseUrl + this.imageWidth + '/' + this.imageHeight
                return true;
            }
    
            if (preset) {
                this.urlToDisplay = this.baseUrl + this.imagePreset
            }
        },
        isValid(num) {
            console.log('isValid : ' + num)
            if (typeof num != 'string') return false
            return !isNaN(num) && !isNaN(parseFloat(num) && num > 299)
        }
    }">
        <x-navigation :colorName="$colorName" activeRoute="help" />

        <div class="md:hidden bg-{{ $colorName }}-900 rounded-lg p-2">
            <!-- small version -->
            <h1 class="text-2xl font-semibold">{{ $pageTitle }}</h1>

            @include('partials.urlHelper')
        </div>

        <div class="hidden md:block bg-{{ $colorName }}-900 rounded-lg">
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
