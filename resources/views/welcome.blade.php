@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
<section class="relative w-full h-[600px] flex items-center justify-center overflow-hidden rounded-b-3xl" id="home">
    {{-- Background Images --}}
    <div class="absolute inset-0 w-full h-full -z-10 overflow-hidden">
        <img id="bannerImage" src="{{ asset('banner1.jpg') }}" alt="Banner"
            class="w-full h-full object-cover object-center absolute inset-0 transition-opacity duration-1000">
    </div>

    {{-- Banner Content --}}
    <div class="relative z-10 flex flex-col justify-center h-full py-24 px-8 max-w-3xl">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-6 leading-tight">
            Bienvenue sur Notre Site
        </h1>
        <p class="text-lg md:text-xl text-white/80 mb-8">
            Découvrez nos services professionnels et nos offres exceptionnelles.
        </p>
        <div class="flex gap-4">
            <a class="px-8 py-3 rounded-md bg-blue-600 text-white font-semibold shadow-md hover:bg-white hover:text-primary transition-colors duration-200"
                href="#services">
                Nos services
            </a>
            <a href="/works"
                class="px-8 py-3 rounded-md bg-white text-primary font-semibold shadow-md hover:bg-primary hover:text-white transition-colors duration-200 cursor-pointer">
                Offre De Service
            </a>
        </div>
    </div>
</section>

<section class="w-full py-20 bg-gray-50" id="services">
    <div class="max-w-6xl mx-auto px-2 sm:px-4">
        <!-- Title -->
        <h2 class="text-3xl font-bold text-center text-[var(--color-primary)] mb-4">
            Nos Services
        </h2>
        <p class="text-center text-gray-600 mb-10">
            Choisissez une catégorie pour découvrir nos services spécialisés.
        </p>

        <!-- Category Filter -->
        <div class="flex flex-wrap gap-4 mb-8 justify-center w-full">
            <!-- IZDTECH -->
            <button
                class="px-6 py-2 rounded-full font-semibold border transition-all duration-300 overflow-hidden flex items-center gap-2 bg-[var(--color-primary)] text-white border-[var(--color-primary)] shadow-[0_0_10px_var(--color-primary)] animate-primary-glow">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6.827 6.175A4.992 4.992 0 0 1 12 4.5c1.418 0 2.691.586 3.584 1.528M17.657 16.657A8 8 0 1 0 6.343 6.343a8 8 0 0 0 11.314 11.314z" />
                </svg>
                IZDTECH
            </button>

            <!-- IZDFIRE -->
            <button
                class="relative flex items-center gap-2 px-6 py-2 rounded-full font-semibold border transition-all duration-300 overflow-hidden bg-red-600 text-white border-red-600 shadow-[0_0_10px_rgba(255,0,0,0.8)] animate-fire-glow">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 24 24" class="w-4 h-4">
                    <path d="M12 2C10 5 7 8.5 7 13a5 5 0 1 0 10 0c0-4.5-3-8-5-11z" />
                </svg>
                IZDFIRE
            </button>
        </div>

        <!-- Services Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            <!-- Fire Service Card -->
            <div
                class="bg-white w-full max-w-sm rounded-xl shadow-md hover:shadow-lg duration-300 p-4 flex flex-col items-center text-center border border-gray-100 hover:-translate-y-1 transform transition-transform cursor-pointer">
                <div
                    class="w-full h-40 mb-4 rounded-xl overflow-hidden flex items-center justify-center bg-gradient-to-tr from-red-600 via-white to-red-500 ring-4 ring-red-400 animate-fire-glow">
                    <img src="https://via.placeholder.com/300x200" alt="Fire Service"
                        class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-1">
                    Fire Safety Service
                </h3>
                <p class="text-gray-500 text-sm leading-snug">
                    Professional fire prevention and safety inspections for businesses and homes.
                </p>
                <a href="#"
                    class="mt-3 px-3 py-1.5 rounded-md shadow-sm transition duration-200 text-xs font-medium bg-red-600 text-white hover:bg-red-700 shadow-red-500">
                    Details
                </a>
            </div>

            <!-- Tech Service Card -->
            <div
                class="bg-white w-full max-w-sm rounded-xl shadow-md hover:shadow-lg duration-300 p-4 flex flex-col items-center text-center border border-gray-100 hover:-translate-y-1 transform transition-transform cursor-pointer">
                <div
                    class="w-full h-40 mb-4 rounded-xl overflow-hidden flex items-center justify-center bg-[var(--color-primary)] ring-4 ring-[var(--color-primary)] animate-primary-glow">
                    <img src="https://via.placeholder.com/300x200" alt="Tech Service"
                        class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-1">
                    IZDTECH Solutions
                </h3>
                <p class="text-gray-500 text-sm leading-snug">
                    Innovative technology solutions tailored for modern businesses.
                </p>
                <a href="#"
                    class="mt-3 px-3 py-1.5 rounded-md shadow-sm transition duration-200 text-xs font-medium bg-[var(--color-primary)] text-white hover:bg-[var(--color-secondary)] shadow-[var(--color-primary)]">
                    Details
                </a>
            </div>
        </div>

        <!-- Pagination -->
        <div class="flex justify-center mt-8 gap-2">
            <button class="px-3 py-1 border rounded hover:bg-gray-100">Précédent</button>
            <button class="px-3 py-1 border rounded hover:bg-gray-100">Suivant</button>
        </div>
    </div>
</section>
{{-- contact section --}}
<section class="w-full p-20 bg-gray-50 max-md:p-3" id="contact">
    <form class="bg-white rounded-2xl shadow-lg p-0 mx-auto flex flex-col md:flex-row border border-gray-100 overflow-hidden w-full">

        {{-- Section gauche : En-tête --}}
        <div class="bg-gradient-to-br from-[var(--color-primary)] to-[var(--color-secondary)] text-white w-full md:w-1/2 p-10 flex flex-col justify-center">
            <h2 class="text-4xl font-extrabold mb-4">Contactez-nous</h2>
            <p class="text-white/80 text-lg font-medium">
                Nous serions ravis d’avoir de vos nouvelles ! Remplissez les informations et nous vous répondrons rapidement.
            </p>
        </div>

        {{-- Section droite : Formulaire --}}
        <div class="w-full p-10 flex flex-col gap-6 max-sm:p-4">

            {{-- Email ou téléphone --}}
            <div class="flex flex-col gap-2">
                <label for="emailOrPhone" class="font-bold text-gray-700 text-lg flex items-center gap-2">
                    <i class="fi fi-mail text-[var(--color-primary)]"></i> Email ou Téléphone
                </label>
                <input
                    type="text"
                    id="emailOrPhone"
                    class="px-5 py-3 rounded-md border border-gray-200 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)] text-gray-900 font-semibold shadow"
                    placeholder="Entrez votre email ou numéro de téléphone" />
            </div>

            {{-- Sujet --}}
            <div class="flex flex-col gap-2">
                <label for="subject" class="font-bold text-gray-700 text-lg flex items-center gap-2">
                    <i class="fi fi-edit-2 text-[var(--color-primary)]"></i> Sujet
                </label>
                <input
                    type="text"
                    id="subject"
                    class="px-5 py-3 rounded-md border border-gray-200 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)] text-gray-900 font-semibold shadow"
                    placeholder="Sujet de votre message" />
            </div>

            {{-- Message --}}
            <div class="flex flex-col gap-2">
                <label for="content" class="font-bold text-gray-700 text-lg flex items-center gap-2">
                    <i class="fi fi-message-circle text-[var(--color-primary)]"></i> Message
                </label>
                <textarea
                    id="content"
                    rows="5"
                    class="px-5 py-3 rounded-md border border-gray-200 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)] text-gray-900 font-semibold resize-none shadow"
                    placeholder="Tapez votre message ici..."></textarea>
            </div>

            {{-- Bouton d'envoi --}}
            <div class="flex justify-end">
                <button
                    type="submit"
                    class="flex items-center gap-2 px-8 py-3 rounded-md font-bold shadow-md transition duration-200 text-lg bg-[var(--color-secondary)] hover:bg-[var(--color-primary)] text-white">
                    <i class="fi fi-send text-xl"></i> Envoyer
                </button>
            </div>
        </div>
    </form>
</section>
<footer
    class="w-full bg-gradient-to-br from-blue-600 to-indigo-700 text-white pt-16 pb-8 mt-16"
    id="info">

    <div class="max-w-6xl mx-auto px-4 grid grid-cols-1 md:grid-cols-2 gap-16 items-start">

        {{-- Left section --}}
        <div class="flex flex-col gap-6">

            {{-- Logo --}}
            <div>
                <span class="text-3xl font-extrabold tracking-wide text-white">
                    IZDTECH
                </span>
            </div>

            {{-- Contact Info --}}
            <div class="flex flex-col gap-3 text-white/80 text-sm">
                <div class="flex items-start gap-3">
                    <span class="w-6 h-6 flex items-center justify-center text-white">
                        📧
                    </span>
                    <div>
                        <p class="font-semibold">Support Team</p>
                        <p>support@izdtech.com</p>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <span class="w-6 h-6 flex items-center justify-center text-white">
                        📞
                    </span>
                    <div>
                        <p class="font-semibold">Customer Service</p>
                        <p>+213 555 123 456</p>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <span class="w-6 h-6 flex items-center justify-center text-white">
                        📍
                    </span>
                    <div>
                        <p class="font-semibold">Guelma, Algeria</p>
                    </div>
                </div>
            </div>

            {{-- Social Media --}}
            <div class="flex flex-wrap gap-4 mt-4">
                <a href="#"
                    class="flex flex-col items-center gap-1 w-24 transition-transform hover:-translate-y-1 hover:scale-110">
                    <div class="w-10 h-10 flex items-center justify-center rounded-full bg-white/10 text-white hover:bg-white/20">
                        📘
                    </div>
                    <span class="text-white/80 text-xs text-center">Facebook</span>
                </a>

                <a href="#"
                    class="flex flex-col items-center gap-1 w-24 transition-transform hover:-translate-y-1 hover:scale-110">
                    <div class="w-10 h-10 flex items-center justify-center rounded-full bg-white/10 text-white hover:bg-white/20">
                        📸
                    </div>
                    <span class="text-white/80 text-xs text-center">Instagram</span>
                </a>
            </div>

            {{-- Button --}}
            <div class="mt-4">
                <a href="#"
                    class="inline-block px-6 py-2 rounded-md bg-white/10 text-white font-medium shadow-md hover:bg-white/20 transition-all duration-200">
                    Offre De Service
                </a>
            </div>
        </div>

        {{-- Map Section --}}
        <div class="w-full h-96 rounded-xl overflow-hidden shadow-md flex flex-col gap-3">
            <div class="text-white flex items-center gap-2">
                <span>📍</span>
                <span>Our Location</span>
            </div>
            <iframe
                title="Guelma Location"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3195.578765040562!2d7.426904!3d36.465115!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12f0f0b99f0b9f9f%3A0x123456789abcdef!2sGuelma!5e0!3m2!1sen!2sdz!4v1700000000000"
                width="100%"
                height="100%"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>

    </div>


</footer>

<footer class="w-full bg-blue-700 text-white py-4 border-t border-blue-500">
    <div class="max-w-6xl mx-auto px-4 flex flex-col md:flex-row items-center justify-between text-xs md:text-sm gap-2 md:gap-0">

        {{-- Phone --}}
        <div class="flex items-center gap-3">
            {{-- Phone Icon --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-blue-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.129a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.492 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
            </svg>
            <span class="text-blue-100">+213 555 000 111</span>
        </div>

        {{-- Copyright --}}
        <div class="flex items-center gap-2 text-blue-100 flex-wrap justify-center text-center">
            <div class="flex items-center gap-1">
                {{-- Copyright Icon --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 20.5A8.5 8.5 0 1 0 12 3.5a8.5 8.5 0 0 0 0 17Zm0 0a5 5 0 1 1 0-10" />
                </svg>
                <span>{{ date('Y') }} TechNova. Tous droits réservés.</span>
            </div>
            <span class="hidden md:inline">|</span>
            <span>Réalisé par Nova Studio</span>
        </div>

    </div>
</footer>




{{-- Carousel Script --}}
<script>
    const images = [
        "{{ asset('banner1.jpg') }}",
        "{{ asset('banner2.jpg') }}",
        "{{ asset('banner3.jpg') }}"
    ];

    let currentIndex = 0;
    const bannerImage = document.getElementById('bannerImage');

    setInterval(() => {
        currentIndex = (currentIndex + 1) % images.length;
        bannerImage.src = images[currentIndex];
    }, 5000);
</script>
@endsection