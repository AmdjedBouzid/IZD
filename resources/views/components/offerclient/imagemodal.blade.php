<div id="imageModal" class="fixed inset-0 z-[1000] bg-black/90 items-center justify-center hidden">
    {{-- Close Button --}}
    <button
        class="absolute top-6 right-6 text-white text-3xl hover:text-red-400 transition"
        type="button"
        aria-label="Fermer"
        onclick="closeModal()">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>

    {{-- Prev Button --}}
    <button
        class="absolute left-4 text-white text-4xl hover:text-primary transition"
        type="button"
        aria-label="Précédent"
        onclick="showPrev()">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 19l-7-7 7-7" />
        </svg>
    </button>

    {{-- Image --}}
    <img id="fullscreenImage"
        src=""
        alt="Plein écran"
        class="max-w-full max-h-[90vh] object-contain rounded-xl shadow-lg" />

    {{-- Next Button --}}
    <button
        class="absolute right-4 text-white text-4xl hover:text-primary transition"
        type="button"
        aria-label="Suivant"
        onclick="showNext()">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 5l7 7-7 7" />
        </svg>
    </button>
</div>