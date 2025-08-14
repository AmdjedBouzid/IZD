<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-[var(--color-primary)]">
        Galerie
    </h2>

    <div class="flex gap-3">
        <form id="imageUploadForm" action="{{ route('offer-images.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Hidden input for category --}}
            <input type="hidden" name="category_id" id="selectedCategoryId" value="{{ $selectedCategoryId }}">

            {{-- File input --}}
            <input type="file" name="image" id="imageInput" class="hidden" accept="image/*">

            <button
                type="button"
                id="addImageBtn"
                class="bg-[var(--color-primary)] text-white px-4 py-2 rounded-md hover:opacity-90 transition">
                Ajouter une image
            </button>
        </form>

        <button
            id="deleteImagesButton"
            class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 hidden">
            Supprimer
        </button>
    </div>

</div>