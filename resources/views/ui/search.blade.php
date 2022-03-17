<h2 class="my-10 text-2xl text-gray-700">Search for a Vacant</h2>

<form action="{{ route('vacancies.search') }}" method="POST">

    @csrf

    <div class="mb-5">
        <label for="category" class="block text-gray-700 text-sm mb-2">Category: </label>

        <select
            name="category"
            id="category"
            class="block appearance-none w-full border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 p-3 bg-gray-100">

            <option disabled selected>- Select -</option>

            @foreach($categories as $category)
                <option
                    {{ old('category') == $category->id ? 'selected' : ''}}
                    value="{{ $category->id }}">
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        @error('category')
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-3 mb-6" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block">{{ $message }}</span>
            </div>
        @enderror
    </div>
    <div class="mb-5">
        <label for="location" class="block text-gray-700 text-sm mb-2">Location: </label>

        <select
            name="location"
            id="location"
            class="block appearance-none w-full border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 p-3 bg-gray-100">

            <option disabled selected>- Select -</option>

            @foreach($locations as $location)
                <option
                    {{ old('location') == $location->id ? 'selected' : ''}}
                    value="{{ $location->id }}">
                    {{ $location->name }}
                </option>
            @endforeach
        </select>

        @error('location')
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-3 mb-6" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block">{{ $message }}</span>
            </div>
        @enderror
    </div>

    <button type="submit" class="bg-teal-500 w-full hover:bg-teal-600 text-gray-100 font-bold p-3 focus:outline-none focus:shadow-outline uppercase mt-10">Search Vacant</button>
</form>
