        <div class="relative group"
            data-category-id="{{ $image->category_id }}">
            <img src="{{ $image->url }}" alt="Image {{ $image->id }}" class="w-full h-32 object-cover rounded-lg">
            <input
                type="checkbox"
                class="absolute top-2 right-2 w-5 h-5 cursor-pointer opacity-0 group-hover:opacity-100 transition"
                data-id="{{ $image->id }}">

            <div class="absolute inset-0 bg-red-600/20 bg-opacity-40 hidden"></div>
        </div>