@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-20 text-center">
    <div class="text-2xl my-5">{{ __('Verify Your Email Address') }}</div>

    <p>{{ __('Before proceeding, please check your email for a verification link.') }}</p>
    <p class="mt-3">{{ __('If you did not receive the email') }}.</p>
    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit" class="mt-10 max-w-sm bg-teal-500 w-full hover:bg-teal-700 text-gray-100 p-3 focus:outline-none focus:shadow-outline uppercase font-bold">{{ __('click here to request another') }}</button>
        
        @if (session('resent'))
            <span class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 w-full my-3 block text-sm" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </span>
        @endif
    </form>
</div>
@endsection
