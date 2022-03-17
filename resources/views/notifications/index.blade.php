@extends('layouts.app')

@section('navigation')
    @include('ui.adminav')
@endsection

@section('content')
    <h1 class="text-2xl text-center mt-10">Notifications</h1>

    @if (count($notifications) > 0)
        <ul class="max-w-md mx-auto mt-10">
            @foreach ($notifications as $notification)
                @php
                    $data = $notification->data
                @endphp

                <li class="p-5 border border-gray-400 mb-5">
                    <p class="mb-4">
                        You have a new candidate in:
                        <span class="font-bold">{{ $data['vacant'] }}</span>
                    </p>

                    <p class="mb-4">
                        He wrote you:
                        <span class="font-bold">{{ $notification->created_at->diffForHumans() }}</span>
                    </p>

                    <a class="bg-teal-500 p-3 inline-block text-xs font-bold uppercase text-white" href="{{ route('candidates.index', ['id' => $data['id_vacant']]) }}" class="mb-4">
                        View Candidate
                    </a>
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-center mt-5">No Notifications</p>
    @endif
@endsection
