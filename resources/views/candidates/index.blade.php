@extends('layouts.app')

@section('navigation')
    @include('ui.adminav')
@endsection

@section('content')
    <h1 class="text-2xl text-center mt-10">Candidates: {{ $vacant->title }}</h1>

    @if(count($vacant->candidates) > 0)
        <ul class="max-w-md mx-auto mt-10">
            @foreach($vacant->candidates as $candidate)
                <li class="p-5 border border-gray-400 mb-5">
                    <p class="mb-4">
                        Name: <span class="font-bold">{{ $candidate->name }}</span>
                    </p>
                    <p class="mb-4">
                        Email: <span class="font-bold">{{ $candidate->email }}</span>
                    </p>
                    <a class="bg-teal-500 p-3 inline-block text-xs font-bold uppercase text-white" href="/storage/cv/{{ $candidate->cv }}" target="_blank">View CV</a>
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-center mt-5">No Candidates</p>
    @endif
@endsection
