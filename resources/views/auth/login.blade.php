@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="flex flex-wrap justify-center">
        <div class="w-full max-w-sm">
            <div class="flex flex-col break-words bg-white border border-2 shadow-md mt-20">
                <div class="bg-gray-300 text-gray-700 uppercase text-center py-3 px-6 mb-0">
                    {{ __('Login') }}
                </div>
                <form class="px-5 py-10" method="POST" action="{{ route('login') }}" novalidate>
                    @csrf

                    <div class="flex flex-wrap mb-6">
                        <label for="email" class="block text-gray-700 text-sm mb-2">{{ __('Email Address') }}</label>

                        <input id="email" type="email" class="p-3 bg-gray-200 rounded form-input w-full @error('email') border-red-500 border @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

                        <span class="block text-gray-700 text-sm mb-2 font-bold">For example: demo1@example.com</span>

                        @error('email')
                            <span class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 w-full mt-5 text-sm" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="flex flex-wrap mb-6">
                        <label for="password" class="block text-gray-700 text-sm mb-2">{{ __('Password') }}</label>

                        <input id="password" type="password" class="p-3 bg-gray-200 rounded form-input w-full @error('password') border-red-500 border @enderror" name="password" autocomplete="current-password">

                        <span class="block text-gray-700 text-sm mb-2 font-bold">For example: demo1234</span>

                        @error('password')
                            <span class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 w-full mt-5 text-sm" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="flex flex-wrap mb-6">
                        <input class="mr-2 mt-1" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="block text-gray-700 text-sm mb-2" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>

                    <div class="flex flex-wrap mb-6">
                        <button
                            type="submit"
                            class="bg-teal-500 w-full hover:bg-teal-700 text-gray-100 p-3 focus:outline-none focus:shadow-outline uppercase font-bold">
                            {{ __('Login') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="text-sm text-gray-500 mt-5 text-center w-full no-underline hover:underline" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
