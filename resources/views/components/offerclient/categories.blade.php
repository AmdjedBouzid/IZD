<div class="flex flex-wrap gap-3 justify-center mb-10">
    {{-- Loop through categories --}}
    @foreach ($categories as $category)
    <form action="{{ route('offer.images.index.client') }}" method="GET">
        <input type="hidden" name="category_id" value="{{ $category->id }}">
        <button type="submit" class="px-5 py-2 rounded-full text-sm font-medium transition-all duration-200 {{ $selectedCategoryId == $category->id ? 'bg-primary text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
            {{ $category->name }}
        </button>
        <input type="hidden" name="category_id" value="{{ $category->id }}">
    </form>
    @endforeach
</div>