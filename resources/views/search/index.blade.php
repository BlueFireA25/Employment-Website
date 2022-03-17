@extends('layouts.app')

@section('navigation')
    @if (Auth::user())
        @include('ui.adminav')
    @endif

    @include('ui.categoriesnav')
@endsection

@section('content')

    @if (count($vacancies) > 0 )
        <h1 class="text-3xl text-gray-700 m-0">
            Search results
        </h1>
        <div class="my-10 bg-gray-100 p-10 shadow">
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
    @else
        <p class="text-center text-gray-700">There are no vacancies that match your search</p>
    @endif

@endsection
