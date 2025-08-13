<div class="flex flex-wrap gap-3 items-center my-6"
    id="categoryContainer">
    @foreach ($categories as $cat)
    <div
        data-category-id="{{$cat->id}}"
        data-category-name="{{$cat->name}}"
        class="flex items-center gap-2 border px-4 py-1 rounded-full cursor-pointer transition bg-gray-100 hover:bg-gray-200">
        <span>{{ $cat->name }}</span>
        <button
            type="button"
            class="text-gray-500 hover:text-red-500 transition"
            title="Delete category">
            {{-- Trash icon SVG --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

    </div>
    @endforeach
    <x-offers.addCategoryInput />
</div>