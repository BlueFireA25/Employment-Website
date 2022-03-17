@extends('layouts.app')

@section('navigation')
    @include('ui.adminav')
@endsection

@section('content')
    <h1 class="text-2xl text-center mt-10">Manage Vacancies</h1>

    @if(count($vacancies) > 0)
        <div class="flex flex-col mt-10">
            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                    <table class="min-w-full">
                        <thead class="bg-gray-100 ">
                            <tr>
                                <th class="px-6 py-3 border-b border-gray-200  text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">
                                    Vacant Title
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200  text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200  text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">
                                    Candidates
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200  text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>

                        <tbody class="bg-white">
                            @foreach ($vacancies as $vacant)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <div class="text-sm leading-5 font-medium text-gray-900">{{ $vacant->title }}</div>
                                            <div class="text-sm leading-5 text-gray-500">Category: {{ $vacant->category->name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <status-vacant status="{{ $vacant->active }}" vacant-id="{{ $vacant->id }}"></status-vacant>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
                                    <a href="{{ route('candidates.index', ['id' => $vacant->id]) }}" class="text-gray-500 hover:text-gray-600">{{ $vacant->candidates->count() }} Candidates</a>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 font-medium">
                                    <a href="{{ route('vacancies.edit', ['vacant' => $vacant->id]) }}" class="text-teal-600 hover:text-teal-900 mr-5">Edit</a>
                                    <delete-vacant vacant-id="{{ $vacant->id }}"></delete-vacant>
                                    <a href="{{ route('vacancies.show', ['vacant' => $vacant->id]) }}" class="text-blue-600 hover:text-blue-900">View</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{ $vacancies->links() }}
    @else
        <p class="text-center mt-10 text-gray-700">You don't have vacancies yet</p>
    @endif
@endsection
