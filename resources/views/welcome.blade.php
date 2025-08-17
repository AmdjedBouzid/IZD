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
        <div class="flex gap-4">
            <a class="px-8 py-3 rounded-md bg-[var(--color-primary)] text-white font-semibold shadow-md hover:bg-white hover:text-[var(--color-primary)] transition-colors duration-200"
                href="#services">
                Nos services
            </a>
         
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
            <button data-company="{{ $company->id }}" data-company_name="{{ $company->name }}"
                class="company-btn px-6 py-2 rounded-full font-semibold border border-red-600 text-red-600 transition-all duration-300 overflow-hidden flex items-center gap-2 opacity-100 hover:bg-red-600 hover:text-white">
 @if (strtoupper($company->name) === 'IZDFIRE')<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-flame-icon lucide-flame"><path d="M8.5 14.5A2.5 2.5 0 0 0 11 12c0-1.38-.5-2-1-3-1.072-2.143-.224-4.054 2-6 .5 2.5 2 4.9 4 6.5 2 1.6 3 3.5 3 5.5a7 7 0 1 1-14 0c0-1.153.433-2.294 1-3a2.5 2.5 0 0 0 2.5 2.5z"/></svg>@else
 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-camera-icon lucide-camera"><path d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z"/><circle cx="12" cy="13" r="3"/></svg>
  @endif
                {{ $company->name }}
            </button>
            @endforeach
        </div>

        @if($services->isNotEmpty())
        <div id="servicesGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8 justify-items-center">
            @foreach($services as $service)

@php
    $words = str_word_count(strip_tags($service->description), 1);
    $shortDescription = implode(' ', array_slice($words, 0, 15)) . (count($words) > 15 ? '...' : '');
@endphp

<a class="service-card bg-white w-full max-w-sm rounded-xl shadow-md hover:shadow-lg duration-300 p-4 flex flex-col items-center text-center border border-gray-100 transform transition-transform cursor-pointer hover:-translate-y-1"

href="{{ url('/service_details/' . $service->id) }}"

data-company_name="{{ $service->company->name }}"
    data-company="{{ $service->company_id }}">

    <div class="w-full h-40 mb-4 rounded-xl overflow-hidden flex items-center justify-center bg-gradient-to-tr from-[var(--color-primary)] via-white to-[var(--color-primary)] ring-4 ring-[var(--color-primary)] imageContainer"
    data-company_name="{{ $service->company->name }}"
    >
        @if($service->image_path)
            <img src="{{ asset('storage/' . $service->image_path) }}"
                class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
        @endif
    </div>

    <h3 class="text-lg font-semibold text-gray-800 mb-1">{{ $service->title }}</h3>

    <p class="text-gray-500 text-sm leading-snug">{{ $shortDescription }}</p>

    @if(count($words) > 15)
        <div 

            class="mt-6 px-3 py-1.5 rounded-md shadow-sm transition duration-200 text-xs font-medium bg-[var(--color-primary)] text-white hover:bg-opacity-90 w-[40%] mx-auto serviceDetailsButtons"
            data-company_name="{{ $service->company->name }}"
            >
            Details
        </div>
    @endif
</a>


            @endforeach
        </div>
        @endif

    </div>
</section>
@endif

{{-- Contact Section --}}
<section class="w-full p-20 bg-gray-50 max-md:p-3" id="contact">
    @error('error')
    <x-toast-error message="{{ $message }}" />
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
            @error('from') <x-toast-error message="{{ $message }}" /> @enderror

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
            @error('object') <x-toast-error message="{{ $message }}" /> @enderror

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
            @error('content') <x-toast-error message="{{ $message }}" /> @enderror

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
                        <p class="text-[var(--footer-items-color)]">{{ $phone->value }}</p>
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
    @php
        $isMultiple = $contacts['location']->count() > 1;
        $mapHeight = $isMultiple ? 'h-64' : 'h-96';
    @endphp

    <div class="w-full flex flex-col gap-6">
        @foreach($contacts['location'] as $location)
            <div class="w-full {{ $mapHeight }} rounded-xl overflow-hidden shadow-md flex flex-col gap-3">
                <div class="text-[var(--footer-items-color)] flex items-center gap-2">
                    <span>{!! $contactIcons["location"] !!}</span>
                    <span>{{ $location->name }}</span>
                </div>
                <iframe
                    title="{{ $location->name }} Location"
                    src="{{ generateGoogleMapsEmbed($location->value) }}"
                    width="100%"
                    height="100%"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        @endforeach
    </div>
@endif


    </div>
</footer>
@endif

<footer class="w-full bg-[var(--footer-color-primary)] text-[var(--footer-items-color)] py-4 border-t border-[var(--footer-color-secondary)]">
    <div class="max-w-6xl mx-auto px-4 flex flex-col md:flex-row items-center justify-between text-xs md:text-sm gap-2 md:gap-0">

        {{-- Copyright + Réalisé par --}}
        <div class="flex items-center gap-2 text-[var(--footer-items-color)] flex-wrap justify-center text-center">
            <div class="flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[var(--footer-items-color)]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 20.5A8.5 8.5 0 1 0 12 3.5a8.5 8.5 0 0 0 0 17Zm0 0a5 5 0 1 1 0-10" />
                </svg>
                <span>{{ date('Y') }} TechNova. Tous droits réservés.</span>
            </div>
            <span class="hidden md:inline">|</span>
            <span>Réalisé par <strong>INFO DZ</strong></span>
        </div>

        {{-- Téléphone --}}
        <div class="flex items-center gap-2 text-[var(--footer-items-color)]">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.129a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.492 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
            </svg>
            <span>+213 776 637 674</span>
        </div>

    </div>
</footer>



@if(session()->has('success'))
    <x-toast-success message="{{ session('success') }}" />
@endif

@if(session()->has('error'))
    <x-toast-error message="{{ session('error') }}" />
@endif
{{-- <x-toast-error message="Une erreur est survenue !" /> --}}

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
    const imageContainers = document.querySelectorAll(".imageContainer");
    const serviceDetailsButtons = document.querySelectorAll(".serviceDetailsButtons");
    buttons.forEach(btn => {
        btn.addEventListener("click", () => {
            // Reset all buttons
            buttons.forEach(b => {
                b.classList.remove(
                    "shadow-lg",
                    "animate-primary-glow",
                    "animate-fire-glow"
                );
                b.classList.add(...(
                    b.getAttribute("data-company_name").toUpperCase() === 'IZDFIRE'
                    ? "border-red-600 text-red-600".split(" ")
                    : "border-[var(--color-primary)] text-[var(--color-primary)]".split(" ")
                ));
                b.style.backgroundColor = "";
                b.style.borderColor = "";
                b.style.color = "";
            });

            // Active button styling
            btn.classList.remove(
                "border-red-600",
                "text-red-600",
                "hover:bg-red-600",
                "hover:text-white"
            );
            btn.style.backgroundColor = "var(--color-primary)";
            btn.style.borderColor = "var(--color-primary)";
            btn.style.color = "white";
            btn.classList.add("shadow-lg");

            const companyId = btn.getAttribute("data-company");
            const companyName = btn.getAttribute("data-company_name").toUpperCase();

            // Add correct animation to active button
            if (companyName === "IZDFIRE") {
                btn.classList.add("animate-fire-glow");
                btn.style.backgroundColor = "red";
                btn.style.borderColor = "red";
            } else {
                btn.classList.add("animate-primary-glow");
                btn.style.backgroundColor = "var(--color-primary)";
                btn.style.borderColor = "var(--color-primary)";
            }

            // Show only cards for this company and set animation
            cards.forEach(card => {
                if (card.getAttribute("data-company") === companyId) {
                    card.style.display = "block";
                    card.classList.remove("animate-primary-glow", "animate-fire-glow");

                    if (companyName === "IZDFIRE") {
                        card.classList.add("animate-fire-glow");
                    } else {
                        card.classList.add("animate-primary-glow");
                    }
                } else {
                    card.style.display = "none";
                }
            });

              imageContainers.forEach(container => {
            const companyName = container.getAttribute("data-company_name").toUpperCase();
        if (companyName === "IZDFIRE") {
            container.classList.add("animate-fire-glow");
        } else {
            container.classList.add("animate-primary-glow");
        }
    });

    serviceDetailsButtons.forEach(b=>{
        serviceDetailsButtons.forEach(b => {
            const companyName = b.getAttribute("data-company_name").toUpperCase();
            if (companyName === "IZDFIRE") {
                b.style.backgroundColor = "red";
                b.style.borderColor = "red";
                b.classList.add("animate-fire-glow");
            } else {
                b.classList.add("animate-primary-glow");
            }
        });
    })
        });
    });
  

    // Click first button by default
    if (buttons.length) buttons[0].click();



    // Setup pagination container after the services grid
});
document.addEventListener("DOMContentLoaded", () => {
    const buttons = document.querySelectorAll(".company-btn");
    const cards = document.querySelectorAll(".service-card");
    const servicesGrid = document.getElementById('servicesGrid');
    const paginationContainer = document.createElement('div');
    paginationContainer.className = 'pagination flex justify-center mt-4 gap-2';
    servicesGrid.parentNode.insertBefore(paginationContainer, servicesGrid.nextSibling);

    const itemsPerPage = 6;
    let currentPage = 1;
    let filteredCards = Array.from(cards); // store currently active set

    function scrollToServices() {
        document.getElementById("services").scrollIntoView({ behavior: "smooth" });
    }

    function showPage(page) {
        filteredCards.forEach((card, index) => {
            card.style.display = (index >= (page - 1) * itemsPerPage && index < page * itemsPerPage) ? 'block' : 'none';
        });
    }

    function renderPagination(activeColor) {
        paginationContainer.innerHTML = '';
        const totalPages = Math.ceil(filteredCards.length / itemsPerPage);
        if (totalPages <= 1) return;

        // Prev button
        const prevBtn = document.createElement('button');
        prevBtn.textContent = "Prev";
        prevBtn.className = "px-3 py-1 border rounded";
        prevBtn.disabled = currentPage === 1;
        prevBtn.addEventListener('click', () => {
            if (currentPage > 1) {
                currentPage--;
                showPage(currentPage);
                renderPagination(activeColor);
                scrollToServices();
            }
        });
        paginationContainer.appendChild(prevBtn);

        // Page numbers
        for (let i = 1; i <= totalPages; i++) {
            const btn = document.createElement('button');
            btn.textContent = i;
            btn.className = "px-3 py-1 border rounded";
            if (i === currentPage) {
                btn.style.backgroundColor = activeColor;
                btn.style.color = "#fff";
                btn.classList.add("shadow-md");
            }
            btn.addEventListener('click', () => {
                currentPage = i;
                showPage(currentPage);
                renderPagination(activeColor);
                scrollToServices();
            });
            paginationContainer.appendChild(btn);
        }

        // Next button
        const nextBtn = document.createElement('button');
        nextBtn.textContent = "Next";
        nextBtn.className = "px-3 py-1 border rounded";
        nextBtn.disabled = currentPage === totalPages;
        nextBtn.addEventListener('click', () => {
            if (currentPage < totalPages) {
                currentPage++;
                showPage(currentPage);
                renderPagination(activeColor);
                scrollToServices();
            }
        });
        paginationContainer.appendChild(nextBtn);
    }

    function filterByCompany(btn) {
        const companyId = btn.getAttribute("data-company");
        const activeColor = btn.style.backgroundColor || "var(--color-primary)";
        filteredCards = Array.from(cards).filter(card => card.getAttribute("data-company") === companyId);
        currentPage = 1;
        showPage(currentPage);
        renderPagination(activeColor);
    }

    // Extend company button functionality
    buttons.forEach(btn => {
        btn.addEventListener("click", () => {
            filterByCompany(btn);
        });
    });

    // Show pagination & first set on load
    if (buttons.length) {
        filterByCompany(buttons[0]); // show first company's cards
    }
});


</script>


@endsection