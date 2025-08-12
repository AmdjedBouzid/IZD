@vite('resources/css/app.css')

@extends('layouts.admin')

@section('title', 'Informations')

@section('content')
<div class="p-8 space-y-12 bg-white rounded-xl shadow-md">
    <h2 class="text-3xl font-bold text-primary">
        Gérer les images des bannières et les métadonnées du site Web
    </h2>

    <div class="border-2 border-dashed border-primary p-8 rounded-xl flex flex-col items-center justify-center text-center bg-primary/10">
        <p class="mb-2 text-sm text-primary">
            Glissez-déposez ou cliquez pour téléverser
        </p>
        <form id="upload-form" action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @error('image_path')
                <div class="text-danger" style="color:red">{{ $message }}</div>
            @enderror
            <input
                type="file"
                accept="image/*"
                class="hidden"
                id="banner-upload"
                name="image_path" />
        </form>
        <label
            for="banner-upload"
            class="cursor-pointer text-primary font-semibold underline">
            Upload Banner Image
        </label>
    </div>

    <div id="banners" class="grid grid-cols-3 gap-6">
        @if($banners->isNotEmpty() && $banners->first()->image_path)
            @foreach($banners as $banner)
                <div data-id="{{ $banner->id }}" class="banner relative group border-2 rounded-xl overflow-hidden cursor-pointer transition-all border-gray-300">
                    <img src="{{ Storage::url($banner->image_path) }}"
                        alt="Banner image {{ $loop->iteration }}"
                        class="w-full h-32 object-cover transition-transform duration-200 group-hover:scale-105">
                </div>
            @endforeach
        @endif
    </div>

    <button id="delete-btn" class="mt-6 px-6 py-2 bg-red-600 text-white rounded-xl font-semibold hidden">
        Supprimer
    </button>

  <form action="{{ route('metadata.update', $metadata->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')


    <div class="bg-white p-6 rounded-xl shadow-md max-w-3xl mx-auto mt-6 space-y-6">

        
        <div>
            <label for="logo-upload" class="block text-sm font-semibold text-gray-700 mb-2">Logo</label>

            <!-- Existing logo preview -->
            <div class="mb-4">
                <img
                    id="logo-preview"
                    src="{{ Storage::url($metadata->website_logo_path) }}"
                    alt="Logo preview"
                    class="w-40 h-auto rounded-md border border-gray-300 object-contain" />
            </div>

            <!-- File input with custom style -->
            <label
                for="logo-upload"
                class="cursor-pointer inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md shadow-sm text-sm font-medium select-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M12 12v8m0 0l-4-4m4 4l4-4m-4-4V4" />
                </svg>
                Choisir un nouveau logo
            </label>
            <input
                id="logo-upload"
                name="website_logo_path"
                type="file"
                accept="image/*"
                class="hidden"
                onchange="previewLogo(event)" />
            
            @error('website_logo_path')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Nom du site Web input --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1" for="website_name">
                Nom du site Web
            </label>
            <input
                id="website_name"
                value="{{ old('website_name', $metadata->website_name) }}"
                name="website_name"
                type="text"
                placeholder="Entrez un nom du site Web..."
                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)]" />
            @error('website_name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Texte en gras input --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1" for="huge_title">
                Texte en gras
            </label>
            <input
                value="{{ old('huge_title', $metadata->huge_title) }}"
                id="huge_title"
                name="huge_title"
                type="text"
                placeholder="Entrez un texte en gras..."
                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)]" />
            @error('huge_title')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Paragraphe input --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1" for="description">
                Paragraphe
            </label>
            <textarea
                id="description"
                name="description"
                rows="4"
                placeholder="Entrez un paragraphe..."
                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)]">{{ old('description', $metadata->description) }}</textarea>
            @error('description')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Color picker input --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1" for="color">
                Couleur principale
            </label>
            <input
                id="color"
                name="font_color"
                type="color"
                value="{{ old('font_color', $metadata->font_color)  }}"
                class="w-16 h-10 p-0 border border-gray-300 rounded-md cursor-pointer focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)]" />
            @error('font_color')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Submit button --}}
        <div class="text-right">
            <button
                type="submit"
                class="bg-[var(--color-primary)] text-white px-5 py-2 rounded-md font-semibold hover:bg-opacity-90 transition">
                Sauvegarder
            </button>
        </div>

    </div>

    </form>
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
    document.getElementById('banner-upload').addEventListener('change', function() {
        if(this.files.length > 0) {
            document.getElementById('upload-form').submit();
        }
    });

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
        
        confirmBtn.addEventListener('click', () => {
            if (selectedBanners.size === 0) return alert('No banners selected.');
    
            const idsArray = Array.from(selectedBanners);
    
            fetch("{{ route('banners.deleteMultiple') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ ids: idsArray }),
            })
            .then(res => res.json())
            .then(data => {
                location.reload();
            })
            .catch((error) => {
                // console.error('Delete failed:', error);
                alert('Delete failed: ' + (error.message || error));
            });
        });
    });

    

</script>
@endsection