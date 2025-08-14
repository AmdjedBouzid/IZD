@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
@php
    function generateGoogleMapsEmbed($input) {
        if (filter_var($input, FILTER_VALIDATE_URL)) {
            if (preg_match('/@([-0-9.]+),([-0-9.]+)/', $input, $matches)) {
                $lat = $matches[1];
                $lng = $matches[2];
                return "https://maps.google.com/maps?q={$lat},{$lng}&hl=fr&z=14&output=embed";
            }
            if (preg_match('/maps\/place\/([^\/]+)/', $input, $matches)) {
                $place = urldecode($matches[1]);
                return "https://maps.google.com/maps?q=" . urlencode($place) . "&hl=fr&z=14&output=embed";
            }
        }
        return "https://maps.google.com/maps?q=" . urlencode($input) . "&hl=fr&z=14&output=embed";
    }
@endphp

<section class="relative w-full h-[600px] flex items-center justify-center overflow-hidden rounded-b-3xl" id="home">
    <div class="absolute inset-0 w-full h-full -z-10 overflow-hidden">
        @if($banners->isNotEmpty() && $banners->first()->image_path)
        <img id="bannerImage" src="{{ asset('storage/' . $banners->first()->image_path) }}" alt="Banner"
            class="w-full h-full object-cover object-center absolute inset-0 transition-opacity duration-1000">
        @endif
    </div>

    <div class="relative z-10 flex flex-col justify-center h-full py-24 px-8 max-w-3xl">
        <h1 style="color: {{ $metadata->font_color }};" class="text-4xl md:text-5xl font-bold mb-6 leading-tight">
            {{ $metadata->huge_title }}
        </h1>
        <p class="text-lg md:text-xl mb-8" style="color: {{ $metadata->font_color }}; opacity: 0.8">
            @if( $metadata->description )
            {{ $metadata->description }}
            @endif
        </p>
        @if( $services->isNotEmpty() )
        <div class="flex gap-4">
            <a class="px-8 py-3 rounded-md bg-[var(--color-primary)] text-white font-semibold shadow-md hover:bg-white hover:text-[var(--color-primary)] transition-colors duration-200"
            href="#services">
            Nos services 
        </a>
        @endif
            <a href="{{ route('offer.images.index.client') }}"
                class="px-8 py-3 rounded-md bg-white text-[var(--color-primary)] font-semibold shadow-md hover:bg-[var(--color-primary)] hover:text-white transition-colors duration-200 cursor-pointer">
                Offre De Service
            </a>
        </div>
    </div>
</section>

@if( $companies->isNotEmpty() )
<section class="w-full py-20 bg-gray-50" id="services">
    <div class="max-w-6xl mx-auto px-2 sm:px-4">
        <h2 class="text-3xl font-bold text-center text-[var(--color-primary)] mb-4">
            Nos Services
        </h2>
        <p class="text-center text-gray-600 mb-10">
            Choisissez une catégorie pour découvrir nos services spécialisés.
        </p>

        <div id="companyTabs" class="flex flex-wrap gap-4 mb-8 justify-center w-full">
           @foreach($companies as $company)
                <button data-company="{{ $company->id }}"
                    class="company-btn px-6 py-2 rounded-full font-semibold border border-red-600 text-red-600 transition-all duration-300 overflow-hidden flex items-center gap-2 opacity-100 hover:bg-red-600 hover:text-white">
                    {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 24 24" class="w-4 h-4">
                        <path d="M12 2C10 5 7 8.5 7 13a5 5 0 1 0 10 0c0-4.5-3-8-5-11z" />
                    </svg> --}}
                    {{ $company->name }}
                </button>
            @endforeach
        </div>

        @if($services->isNotEmpty())
        <div id="servicesGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8 justify-items-center">
            @foreach($services as $service)
                <div class="service-card bg-white w-full max-w-sm rounded-xl shadow-md hover:shadow-lg duration-300 p-4 flex flex-col items-center text-center border border-gray-100 transform transition-transform cursor-pointer hover:-translate-y-1"
                    data-company="{{ $service->company_id }}">
                    
                    <div class="w-full h-40 mb-4 rounded-xl overflow-hidden flex items-center justify-center bg-gradient-to-tr from-[var(--color-primary)] via-white to-[var(--color-primary)] ring-4 ring-[var(--color-primary)] animate-primary-glow">
                        @if($service->image_path)
                            <img src="{{ asset('storage/' . $service->image_path) }}"
                                class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                        @endif
                    </div>

                    <h3 class="text-lg font-semibold text-gray-800 mb-1">{{ $service->title }}</h3>
                    <p class="text-gray-500 text-sm leading-snug">{{ $service->description }}</p>
                    <a href="#"
                        class="mt-3 px-3 py-1.5 rounded-md shadow-sm transition duration-200 text-xs font-medium bg-[var(--color-primary)] text-white hover:bg-opacity-90">
                        Details
                    </a>
                </div>
            @endforeach
        </div>
        @endif

    </div>
</section>
@endif

{{-- Contact Section --}}
<section class="w-full p-20 bg-gray-50 max-md:p-3" id="contact">
    @error('error')
    <div style="color: red">{{ $message }}</div>
    @enderror

    <form class="bg-white rounded-2xl shadow-lg p-0 mx-auto flex flex-col md:flex-row border border-gray-100 overflow-hidden w-full" action="{{ route('send-message') }}" method="POST">
        @csrf
        <div class="bg-gradient-to-br from-[var(--color-primary)] to-[var(--color-secondary)] text-white w-full md:w-1/2 p-10 flex flex-col justify-center">
            <h2 class="text-4xl font-extrabold mb-4">Contactez-nous</h2>
            <p class="text-white/80 text-lg font-medium">
                Nous serions ravis d’avoir de vos nouvelles ! Remplissez les informations et nous vous répondrons rapidement.
            </p>
        </div>

        <div class="w-full p-10 flex flex-col gap-6 max-sm:p-4">
            <div class="flex flex-col gap-2">
                <label for="emailOrPhone" class="font-bold text-gray-700 text-lg flex items-center gap-2">
                    <i class="fi fi-mail text-[var(--color-primary)]"></i> Email ou Téléphone
                </label>
                <input required
                    name="from" value="{{ old('from') }}"
                    type="text" id="emailOrPhone"
                    class="px-5 py-3 rounded-md border border-gray-200 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)] text-gray-900 font-semibold shadow"
                    placeholder="Entrez votre email ou numéro de téléphone" />
            </div>
            @error('from') <div style="color: red">{{ $message }}</div> @enderror

            <div class="flex flex-col gap-2">
                <label for="subject" class="font-bold text-gray-700 text-lg flex items-center gap-2">
                    <i class="fi fi-edit-2 text-[var(--color-primary)]"></i> Sujet
                </label>
                <input required
                    name="object" value="{{ old('object') }}"
                    type="text" id="subject"
                    class="px-5 py-3 rounded-md border border-gray-200 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)] text-gray-900 font-semibold shadow"
                    placeholder="Sujet de votre message" />
            </div>
            @error('object') <div style="color: red">{{ $message }}</div> @enderror

            <div class="flex flex-col gap-2">
                <label for="content" class="font-bold text-gray-700 text-lg flex items-center gap-2">
                    <i class="fi fi-message-circle text-[var(--color-primary)]"></i> Message
                </label>
                <textarea required
                    name="content"
                    id="content"
                    rows="5"
                    class="px-5 py-3 rounded-md border border-gray-200 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)] text-gray-900 font-semibold resize-none shadow"
                    placeholder="Tapez votre message ici...">{{ old('content') }}</textarea>
            </div>
            @error('content') <div style="color: red">{{ $message }}</div> @enderror

            <div class="flex justify-end">
                <button type="submit"
                    class="flex items-center gap-2 px-8 py-3 rounded-md font-bold shadow-md transition duration-200 text-lg bg-[var(--color-secondary)] hover:bg-[var(--color-primary)] text-white">
                    <i class="fi fi-send text-xl"></i> Envoyer
                </button>
            </div>
        </div>
    </form>
</section>

@if( $contacts->isNotEmpty() )

<footer
    class="w-full bg-gradient-to-br from-[var(--footer-color-primary)] to-[var(--footer-color-secondary)] text-[var(--footer-items-color)] pt-16 pb-8 mt-16"
    id="info">

    <div class="max-w-6xl mx-auto px-4 grid grid-cols-1 md:grid-cols-2 gap-16 items-start">

        {{-- Left section --}}
        <div class="flex flex-col gap-6">

            {{-- Logo --}}
            <div>
                <span class="text-3xl font-extrabold tracking-wide text-[var(--footer-items-color)]">
                    {{ $metadata->website_name }}
                </span>
            </div>

            {{-- Contact Info --}}
            <div class="flex flex-col gap-3 text-[var(--footer-items-color)]/80 text-sm">
                @if( isset($contacts['email']) )
                @foreach($contacts['email'] as $email)
                <div class="flex items-start gap-3">
                    <span class="w-6 h-6 flex items-center justify-center text-[var(--footer-items-color)]">
                        {!! $contactIcons["email"] !!}
                    </span>
                    <div>
                        <p class="font-semibold text-[var(--footer-items-color)]">{{ ucfirst($email->name) }}</p>
                        <p class="text-[var(--footer-items-color)]">{{ $email->value }}</p>
                    </div>
                </div>
                @endforeach
                @endif

                @if( isset($contacts['phone']) )
                @foreach($contacts['phone'] as $phone)
                <div class="flex items-start gap-3">
                    <span class="w-6 h-6 flex items-center justify-center text-[var(--footer-items-color)]">
                        {!! $contactIcons["phone"] !!}
                    </span>
                    <div>
                        <p class="font-semibold text-[var(--footer-items-color)]"> {{ ucfirst($phone->name) }}</p>
                        <p class="text-[var(--footer-items-color)]" >{{ $phone->value }}</p>
                    </div>
                </div>
                @endforeach
                @endif

                @if( isset($contacts['location']) )
                @foreach($contacts['location'] as $location)
                <div class="flex items-start gap-3">
                    <span class="w-6 h-6 flex items-center justify-center text-[var(--footer-items-color)]">
                        {!! $contactIcons["location"] !!}
                    </span>
                    <div>
                        <p class="font-semibold text-[var(--footer-items-color)]">{{ ucfirst($location->name) }}</p>
                        <p class="text-[var(--footer-items-color)]" >{{ ucfirst($location->value) }}</p>
                    </div>
                </div>
                @endforeach
                @endif
            </div>

            {{-- Social Media --}}
            <div class="flex flex-wrap gap-4 mt-4">
                @foreach ($contacts as $name => $values)
                @if($name != 'email' && $name != 'phone' && $name != 'location')
                @foreach ($values as $value)
                <a href="{{ $value->value }}"
                        class="flex flex-col items-center gap-1 w-24 transition-transform hover:-translate-y-1 hover:scale-110">
                        <div class="w-10 h-10 flex items-center justify-center rounded-full bg-white/10 text-[var(--footer-items-color)] hover:bg-white/20">
                            {!! $contactIcons[$name] !!}
                        </div>
                        <span class="text-[var(--footer-items-color)]/80 text-xs text-center">{{ $value->name }}</span>
                    </a>
                        @endforeach
                    @endif
                @endforeach
            </div>

            {{-- Button --}}
            @if( $services->isNotEmpty() )
            <div class="mt-4">
                <a href="{{ route('offer.images.index.client') }}"
                    class="inline-block px-6 py-2 rounded-md bg-white/10 text-[var(--footer-items-color)] font-medium shadow-md hover:bg-white/20 transition-all duration-200">
                    Offre De Service
                </a>
            </div>
            @endif
        </div>

        {{-- Map Section --}}
        @if( isset($contacts['location']) && $contacts['location']->isNotEmpty() )
        <div class="w-full h-96 rounded-xl overflow-hidden shadow-md flex flex-col gap-3">
            <div class="text-[var(--footer-items-color)] flex items-center gap-2">
                <span>{!! $contactIcons["location"] !!}</span>
                <span>{{ $contacts['location'][0]->name }}</span>
            </div>
            <iframe
                title="{{$contacts['location'][0]->name}} Location"
                src="<?php echo generateGoogleMapsEmbed($contacts['location'][0]->value); ?>"
                width="100%"
                height="100%"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
        @endif

    </div>
</footer>
@endif

<footer class="w-full bg-[var(--footer-color-primary)] text-[var(--footer-items-color)] py-4 border-t border-[var(--footer-color-secondary)]">
    <div class="max-w-6xl mx-auto px-4 flex flex-col md:flex-row items-center justify-between text-xs md:text-sm gap-2 md:gap-0">

        {{-- Phone --}}
        <div class="flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[var(--footer-items-color)]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.129a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.492 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
            </svg>
            <span class="text-[var(--footer-items-color)]">+213 555 000 111</span>
        </div>

        {{-- Copyright --}}
        <div class="flex items-center gap-2 text-[var(--footer-items-color)] flex-wrap justify-center text-center">
            <div class="flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[var(--footer-items-color)]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 20.5A8.5 8.5 0 1 0 12 3.5a8.5 8.5 0 0 0 0 17Zm0 0a5 5 0 1 1 0-10" />
                </svg>
                <span class="text-[var(--footer-items-color)]">{{ date('Y') }} TechNova. Tous droits réservés.</span>
            </div>
            <span class="hidden md:inline">|</span>
            <span class="text-[var(--footer-items-color)]">Réalisé par Nova Studio</span>
        </div>

    </div>
</footer>



{{-- JS for company buttons & cards --}}
<script>
const images = [
    @foreach($banners as $banner)
    "{{ asset('storage/' . $banner['image_path']) }}",
    @endforeach
];

let currentIndex = 0;
const bannerImage = document.getElementById('bannerImage');

setInterval(() => {
    currentIndex = (currentIndex + 1) % images.length;
    bannerImage.src = images[currentIndex];
}, 5000);

document.addEventListener("DOMContentLoaded", () => {
    const buttons = document.querySelectorAll(".company-btn");
    const cards = document.querySelectorAll(".service-card");

    buttons.forEach(btn => {
        btn.addEventListener("click", () => {
            buttons.forEach(b => {
                b.classList.remove("shadow-lg", "animate-primary-glow");
                b.classList.add("border-red-600", "text-red-600", "hover:bg-red-600", "hover:text-white");
                b.style.backgroundColor = "";
                b.style.borderColor = "";
                b.style.color = "";
            });

            btn.classList.remove("border-red-600", "text-red-600", "hover:bg-red-600", "hover:text-white");
            btn.style.backgroundColor = "var(--color-primary)";
            btn.style.borderColor = "var(--color-primary)";
            btn.style.color = "white";
            btn.classList.add("shadow-lg", "animate-primary-glow");

            const companyId = btn.getAttribute("data-company");
            cards.forEach(card => {
                card.style.display = card.getAttribute("data-company") === companyId ? "block" : "none";
            });
        });
    });

    if (buttons.length) buttons[0].click();
});
</script>
@endsection
