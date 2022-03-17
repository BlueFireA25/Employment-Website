@extends('layouts.app')

@section('navigation')
    @if (Auth::user())
        @include('ui.adminav')
    @endif

    @include('ui.categoriesnav')
@endsection

@section('content')
    <div class="flex flex-col lg:flex-row shadow bg-white">
        <div class="lg:w-1/2 px-8 lg:px-12 py-12 lg:py-24">
            <p class="text-2xl text-gray-700">
                Dev<span class="font-bold">Jobs</span>
            </p>

            <h1 class="mt-2 sm:mt-4 text-3xl font-bold text-gray-700 leading-tight">Find a remote job or in your country <span class="text-teal-500 block">For Developers / Web Designers</span></h1>

            @include('ui.search')
        </div>

        <div class="block lg:w-1/2">
            <img class="inset-0 h-full w-full object-cover object-center" src="{{ asset('img/home.jpg') }}" alt="DevJobs">
        </div>
    </div>

    <div class="my-10 bg-gray-100 p-10 shadow">
        <h2 class="text-3xl text-gray-700 m-0">
            News
            <span class="font-bold">Vacancies</span>
        </h2>

        <ul class="mt-10 grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach ($vacancies as $vacant)
                <li class="p-10 border border-gray-300 bg-white shadow">
                    <h2 class="text-2xl font-bold text-teal-500">{{ $vacant->title }}</h2>

                    <p class="block text-gray-700 font-normal my-2">
                        {{ $vacant->category->name }}
                    </p>
                    <p class="block text-gray-700 font-normal my-2">
                        Location:
                        <span class="font-bold">{{ $vacant->location->name }}</span>
                    </p>
                    <p class="block text-gray-700 font-normal my-2">
                        Experience:
                        <span class="font-bold">{{ $vacant->experience->name }}</span>
                    </p>

                    <a class="bg-teal-500 text-gray-100 mt-2 px-4 py-2 inline-block rounded font-bold text-sm" href="{{ route('vacancies.show', ['vacant' => $vacant->id]) }}">View Vacant</a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
