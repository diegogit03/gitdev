@extends('layouts.base')

@section('body')
    <div class="flex flex-col min-h-screen py-12 bg-gray-100 sm:px-6 lg:px-8">
        @yield('content')

        @isset($slot)
            {{ $slot }}
        @endisset
    </div>
@endsection
