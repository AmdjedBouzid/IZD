@extends('layouts.app')

@section('title', 'Offre De Service')

@section('content')
@if(session()->has('success'))
    <x-toast-success message="{{ session('success') }}" />
@endif
@if(session()->has('error'))
    <x-toast-error message="{{ session('error') }}" />
@endif
<section class="px-6 py-16 max-w-7xl mx-auto relative">
    <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-800 mb-10">
        Offre De Service
    </h2>

    <x-offerclient.categories :categories="$categories" :selectedCategoryId="$selectedCategoryId" />
    <x-offerclient.images :images="$images" />
    <x-offerclient.imagemodal />
    </div>

    <script>
        let currentIndex = 0;
        let imageElements = [];

        function openModal(element) {
            // Store all clickable image containers
            imageElements = Array.from(document.querySelectorAll("[data-image_url]"));

            // Find index of clicked element
            currentIndex = parseInt(element.getAttribute("data-index"));

            // Show modal with clicked image
            document.getElementById("fullscreenImage").src =
                element.getAttribute("data-image_url");
            document.getElementById("imageModal").classList.remove("hidden");
            document.getElementById("imageModal").classList.add("flex");
        }

        function closeModal() {
            document.getElementById("imageModal").classList.add("hidden");
            document.getElementById("imageModal").classList.remove("flex");
        }

        function showPrev() {
            currentIndex =
                (currentIndex - 1 + imageElements.length) % imageElements.length;
            document.getElementById("fullscreenImage").src =
                imageElements[currentIndex].getAttribute("data-image_url");
        }

        function showNext() {
            currentIndex = (currentIndex + 1) % imageElements.length;
            document.getElementById("fullscreenImage").src =
                imageElements[currentIndex].getAttribute("data-image_url");
        }

        // Keyboard navigation
        document.addEventListener("keydown", function(e) {
            const modal = document.getElementById("imageModal");
            if (modal.classList.contains("hidden")) return;

            if (e.key === "Escape") closeModal();
            if (e.key === "ArrowLeft") showPrev();
            if (e.key === "ArrowRight") showNext();
        });
    </script>
    @endsection