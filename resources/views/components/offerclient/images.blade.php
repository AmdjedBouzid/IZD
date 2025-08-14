<div class="grid gap-6 grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
    @foreach ($images as $index => $img)
    <div
        class="overflow-hidden rounded-xl shadow-sm group cursor-pointer"
        data-index="{{ $index }}"
        data-image_url="{{ $img->image_path }}"
        onclick="openModal(this)">
        <img
            src="{{ $img->image_path }}"
            alt="Réalisation"
            class="w-full h-64 object-cover transition-transform duration-300 group-hover:scale-105">
    </div>
    @endforeach
</div>