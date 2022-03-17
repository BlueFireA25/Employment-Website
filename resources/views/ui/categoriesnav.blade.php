@foreach ($categories as $category)
    <a href="{{ route('categories.show', ['category' => $category->id]) }}" class="text-white text-sm uppercase font-bold p-3">
        {{ $category->name }}
    </a>
@endforeach
