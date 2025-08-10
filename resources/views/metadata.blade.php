@vite('resources/css/app.css')
@extends('layouts.admin')

@section('title', 'Informations')

@section('content')
<div class="p-8 space-y-12 bg-white rounded-xl shadow-md">
    <h2 class="text-3xl font-bold text-primary">
        Gérer les images de bannière
    </h2>

    <div class="border-2 border-dashed border-primary p-8 rounded-xl flex flex-col items-center justify-center text-center bg-primary/10">
        <p class="mb-2 text-sm text-primary">
            Glissez-déposez ou cliquez pour téléverser
        </p>
        <input
            type="file"
            accept="image/*"
            class="hidden"
            id="banner-upload" />
        <label
            for="banner-upload"
            class="cursor-pointer text-primary font-semibold underline">
            Upload Banner Image
        </label>
    </div>

    <div id="banners" class="grid grid-cols-3 gap-6">
        {{-- Fake Item 1 --}}
        <div data-id="1" class="banner relative group border-2 rounded-xl overflow-hidden cursor-pointer transition-all border-gray-300">
            <img src="https://via.placeholder.com/300x150"
                alt="Banner image 1"
                class="w-full h-32 object-cover transition-transform duration-200 group-hover:scale-105">
        </div>

        {{-- Fake Item 2 --}}
        <div data-id="2" class="banner relative group border-2 rounded-xl overflow-hidden cursor-pointer transition-all border-gray-300">
            <img src="https://via.placeholder.com/300x150"
                alt="Banner image 2"
                class="w-full h-32 object-cover transition-transform duration-200 group-hover:scale-105">
        </div>

        {{-- Fake Item 3 --}}
        <div data-id="3" class="banner relative group border-2 rounded-xl overflow-hidden cursor-pointer transition-all border-gray-300">
            <img src="https://via.placeholder.com/300x150"
                alt="Banner image 3"
                class="w-full h-32 object-cover transition-transform duration-200 group-hover:scale-105">
        </div>
    </div>

    <button id="delete-btn" class="mt-6 px-6 py-2 bg-red-600 text-white rounded-xl font-semibold hidden">
        Supprimer
    </button>



    <div class="bg-white p-6 rounded-xl shadow-md max-w-3xl mx-auto mt-6 space-y-6">
        {{-- Logo input --}}
        <div class="">
            <label for="logo" class="block text-sm font-semibold text-gray-700 mb-2">Logo</label>

            <!-- Existing logo preview -->
            <div class="mb-4">
                <img
                    id="logo-preview"
                    src="/banner1.jpg"
                    alt="Logo preview"
                    class="w-40 h-auto rounded-md border border-gray-300 object-contain" />
            </div>

            <!-- File input with custom style -->
            <label
                for="logo-upload"
                class="cursor-pointer inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md shadow-sm text-sm font-medium select-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M12 12v8m0 0l-4-4m4 4l4-4m-4-4V4" />
                </svg>
                Choisir un nouveau logo
            </label>
            <input
                id="logo-upload"
                name="logo"
                type="file"
                accept="image/*"
                class="hidden"
                onchange="previewLogo(event)" />
        </div>



        {{-- Bold text input --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1" for="boldText">
                Texte en gras
            </label>
            <input
                id="boldText"
                name="boldText"
                type="text"
                placeholder="Entrez un texte en gras..."
                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)]" />
        </div>

        {{-- Paragraph input --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1" for="paragraph">
                Paragraphe
            </label>
            <textarea
                id="paragraph"
                name="paragraph"
                rows="4"
                placeholder="Entrez un paragraphe..."
                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)]"></textarea>
        </div>

        {{-- Color picker input --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1" for="color">
                Couleur principale
            </label>
            <input
                id="color"
                name="color"
                type="color"
                value="#3490dc"
                class="w-16 h-10 p-0 border border-gray-300 rounded-md cursor-pointer focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)]" />
        </div>

        {{-- Submit button --}}
        <div class="text-right">
            <button
                type="button"
                class="bg-[var(--color-primary)] text-white px-5 py-2 rounded-md font-semibold hover:bg-opacity-90 transition">
                Sauvegarder
            </button>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div id="confirm-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg max-w-md w-full p-6 space-y-4 shadow-lg">
            <h3 class="text-xl font-semibold text-gray-800">Confirmer la suppression</h3>
            <p class="text-gray-600">Êtes-vous sûr de vouloir supprimer les images sélectionnées ? Cette action est irréversible.</p>
            <div class="flex justify-end space-x-4">
                <button id="cancel-btn" class="px-4 py-2 rounded-md bg-gray-300 hover:bg-gray-400 transition font-semibold">
                    Annuler
                </button>
                <button id="confirm-btn" class="px-4 py-2 rounded-md bg-red-600 text-white hover:bg-red-700 transition font-semibold">
                    Supprimer
                </button>
            </div>
        </div>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const banners = document.querySelectorAll('.banner');
        const deleteBtn = document.getElementById('delete-btn');
        const confirmModal = document.getElementById('confirm-modal');
        const cancelBtn = document.getElementById('cancel-btn');
        const confirmBtn = document.getElementById('confirm-btn');

        let selectedBanners = new Set();

        banners.forEach(banner => {
            banner.addEventListener('click', () => {
                const bannerId = banner.getAttribute('data-id');

                if (selectedBanners.has(bannerId)) {
                    // Deselect
                    selectedBanners.delete(bannerId);
                    deselectBanner(banner);
                } else {
                    // Select
                    selectedBanners.add(bannerId);
                    selectBanner(banner);
                }

                toggleDeleteButton();
            });
        });

        deleteBtn.addEventListener('click', () => {
            // Show confirmation modal
            confirmModal.classList.remove('hidden');
        });

        cancelBtn.addEventListener('click', () => {
            // Hide modal
            confirmModal.classList.add('hidden');
        });

        function selectBanner(banner) {
            banner.classList.remove('border-gray-300');
            banner.classList.add('border-primary', 'shadow-xl');

            if (!banner.querySelector('.checkmark-overlay')) {
                let checkmark = document.createElement('div');
                checkmark.className = "checkmark-overlay absolute inset-0 bg-primary/20 bg-opacity-30 flex items-center justify-center";
                checkmark.innerHTML = `<span class="text-white font-bold text-xl">✓</span>`;
                banner.appendChild(checkmark);
            }
        }

        function deselectBanner(banner) {
            banner.classList.remove('border-primary', 'shadow-xl');
            banner.classList.add('border-gray-300');

            const overlay = banner.querySelector('.checkmark-overlay');
            if (overlay) overlay.remove();
        }

        function toggleDeleteButton() {
            if (selectedBanners.size > 0) {
                deleteBtn.classList.remove('hidden');
            } else {
                deleteBtn.classList.add('hidden');
            }
        }
    });
</script>
@endsection