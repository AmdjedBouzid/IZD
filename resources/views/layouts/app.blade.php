<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', '{{ $metadata->website_name }}')</title>
    @vite('resources/css/app.css')
    <link rel="icon" href="{{ Storage::url($metadata->website_logo_path) }}" type="image/png">
    <style>
        .mobile-menu {
            display: none;
        }

        .mobile-menu.active {
            display: flex;
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-800">

    {{-- Navbar --}}
    <nav class="w-full fixed z-50 bg-white text-black shadow">
        <div class="max-w-7xl mx-auto flex items-center justify-between px-8 h-16">
            <div class="font-bold text-2xl tracking-wide cursor-pointer">
                @if (isset($metadata))
                <img
                    id="logo-preview"
                    src="{{ Storage::url($metadata->website_logo_path) }}"
                    alt="Logo preview"
                    class="w-20 h-20" />
                @endif
            </div>

            {{-- Desktop Links --}}
            <ul class="hidden md:flex gap-8 list-none">
                <li><a href="#home" class="nav-link">Accueil</a></li>
                <li><a href="#services" class="nav-link">Services</a></li>
                <li><a href="#contact" class="nav-link">Contactez-nous</a></li>
                <li><a href="#info" class="nav-link">Informations</a></li>
                <li><a href="/works" class="nav-link">Offre De Service</a></li>
            </ul>

            {{-- Mobile Menu Toggle --}}
            <div class="md:hidden flex items-center">
                <button id="menu-toggle" class="text-2xl text-black">☰</button>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <ul id="mobile-menu" class="mobile-menu md:hidden flex-col gap-6 mt-4 bg-white p-6 rounded-xl shadow-md absolute top-16 left-4 right-4 z-50">
            <li><a href="#home" class="nav-link">Accueil</a></li>
            <li><a href="#services" class="nav-link">Services</a></li>
            <li><a href="#contact" class="nav-link">Contactez-nous</a></li>
            <li><a href="#info" class="nav-link">Informations</a></li>
            <li><a href="/works" class="nav-link">Offre De Service</a></li>
        </ul>
    </nav>

    {{-- Main content --}}
    <main class="pt-20">
        @yield('content')
    </main>

    {{-- JS --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const menuToggle = document.getElementById("menu-toggle");
            const mobileMenu = document.getElementById("mobile-menu");
            const links = document.querySelectorAll(".nav-link");

            menuToggle.addEventListener("click", () => {
                mobileMenu.classList.toggle("active");
            });

            links.forEach(link => {
                link.addEventListener("click", function(e) {
                    const href = this.getAttribute("href");
                    if (href.startsWith("#")) {
                        e.preventDefault();
                        document.querySelector(href)?.scrollIntoView({
                            behavior: "smooth"
                        });
                        mobileMenu.classList.remove("active");
                    }
                });
            });
        });
    </script>
</body>

</html>