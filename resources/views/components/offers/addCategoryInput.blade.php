<form action="{{ route('offer-categories.store') }}" method="POST" class="flex items-center gap-2 border px-3 py-1 rounded-full bg-white">
    @csrf
    <input
        type="text"
        name="name"
        placeholder="New category"
        class="outline-none text-sm bg-transparent placeholder-gray-400"
        required />

    <button
        type="submit"
        title="Add category"
        class="text-green-600 hover:text-green-800">
        {{-- Plus icon SVG --}}
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 4v16m8-8H4" />
        </svg>
    </button>
</form>