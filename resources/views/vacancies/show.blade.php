@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" integrity="sha512-ZKX+BvQihRJPA8CROKBhDNvoc2aDMOdAlcm7TUQY+35XYtrd3yh95QOOhsPDQY9QnKE0Wqag9y38OIgEvb88cA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('navigation')
    @include('ui.categoriesnav')
@endsection

@section('content')
    <h1 class="text-3xl text-center mt-19">{{ $vacant->title }}</h1>

    <div class="mt-10 mb-20 md:flex items-start">
        <div class="md:w-3/5">
            <p class="block text-gray-700 font-bold my-2">
                Published: <span class="font-normal">{{ $vacant->created_at->diffForHumans() }}</span>
                by: <span class="font-normal">{{ $vacant->recruiter->name }}</span>
            </p>
            <p class="block text-gray-700 font-bold my-2">
                Category: <span class="font-normal">{{ $vacant->category->name }}</span>
            </p>
            <p class="block text-gray-700 font-bold my-2">
                Salary: <span class="font-normal">{{ $vacant->salary->name }}</span>
            </p>
            <p class="block text-gray-700 font-bold my-2">
                Location: <span class="font-normal">{{ $vacant->location->name }}</span>
            </p>
            <p class="block text-gray-700 font-bold my-2">
                Experience: <span class="font-normal">{{ $vacant->experience->name }}</span>
            </p>

            <h2 class="text-2xl text-center mt-10 text-gray-700 mb-5">Knowledge and technologies</h2>
            @php
                $arraySkills = explode(",", $vacant->skills)
            @endphp

            @foreach($arraySkills as $skill)
                <p class="inline-block border border-gray-500 rounded py-2 px-8 text-gray-700 my-2">
                {{ $skill }}
                </p>
            @endforeach

            <a href="/storage/vacancies/{{ $vacant->image }}" data-lightbox="image" data-title="Vacant {{ $vacant->title  }}">
                <img src="/storage/vacancies/{{ $vacant->image }}" alt="Vacant Image" class="w-40 mt-10">
            </a>

            <div class="description mt-10 mb-5">
                {!! $vacant->description !!}
            </div>
        </div>

        @if($vacant->active === 1)
            <aside class="md:w-2/5 bg-teal-500 p-5 rounded m-3">
                <h2 class="text-2xl my-5 text-white uppercase font-bold text-center">Contact the recruiter</h2>

                <form enctype="multipart/form-data" action="{{ route('candidates.store') }}" method="POST">

                    @csrf

                    <div class="mb-4">
                        <label for="name" class="block text-white text-sm font-bold mb-4">Name:</label>
                        <input type="text" id="name" class="p-3 bg-gray-100 rounded form-input w-full @error('name') border border-red-500 @enderror" name="name" placeholder="Your Name" value="{{ old('name') }}">

                        @error('name')
                            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 w-full mt-5" role="alert">
                                <p>{{ $message }}</p>
                            </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-white text-sm font-bold mb-4">Email:</label>
                        <input type="email" id="email" class="p-3 bg-gray-100 rounded form-input w-full @error('email') border border-red-500 @enderror" name="email" placeholder="Your Email" value="{{ old('email') }}">

                        @error('email')
                            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 w-full mt-5" role="alert">
                                <p>{{ $message }}</p>
                            </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="name" class="block text-white text-sm font-bold mb-4">Curriculum (PDF):</label>
                        <input type="file" id="cv" class="p-3 rounded form-input w-full @error('cv') border border-red-500 @enderror" name="cv" accept="application/pdf">

                        @error('cv')
                            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 w-full mt-5" role="alert">
                                <p>{{ $message }}</p>
                            </div>
                        @enderror
                    </div>

                    <input type="hidden" name="vacant_id" value="{{ $vacant->id }}">

                    <input type="submit" class="bg-teal-600 w-full hover:bg-teal-700 text-gray-100 p-3 focus:outline-none focus:shadow-outline uppercase cursor-pointer" value="Contact">
                </form>
            </aside>
        @endif
    </div>
@endsection
