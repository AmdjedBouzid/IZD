<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 text-gray-800">

    {{-- Mobile Sidebar Toggle --}}
    <button id="sidebar-open" class="md:hidden fixed top-4 left-4 z-50 bg-white p-2 rounded-full shadow border">
        ☰
    </button>
    <div id="sidebar-overlay" class="hidden fixed inset-0 bg-black/30 z-40 md:hidden"></div>

    <div class="flex">
        {{-- Sidebar --}}
        <aside id="sidebar"
            class="fixed top-0 left-0 h-screen w-64 bg-white shadow-md border-r z-50 p-6 transform -translate-x-full transition-transform duration-300 md:translate-x-0">

            {{-- Close button --}}
            <div class="md:hidden flex justify-end mb-4">
                <button id="sidebar-close" class="text-gray-600 hover:text-gray-900">✖</button>
            </div>

            {{-- Logo --}}
            <div class="mb-8">
                <a href="#"><span class="text-2xl font-bold text-gray-800">Panneau Admin</span></a>
            </div>

            {{-- Navigation --}}
            <nav class="flex flex-col space-y-2 mb-6">
                <a href="/admin/metadata"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg
              {{ request()->is('admin/metadata*') ? 'bg-gray-200 text-gray-900 font-semibold' : 'text-gray-700 hover:bg-gray-50' }}">
                    Bannieres
                </a>
                <a href="/admin/services"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg
              {{ request()->is('admin/services*') ? 'bg-gray-200 text-gray-900 font-semibold' : 'text-gray-700 hover:bg-gray-50' }}">
                    Services
                </a>
                <a href="/admin/messages"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg
              {{ request()->is('admin/messages*') ? 'bg-gray-200 text-gray-900 font-semibold' : 'text-gray-700 hover:bg-gray-50' }}">
                    Messages
                </a>
                <a href="/admin/offres"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg
              {{ request()->is('admin/offres*') ? 'bg-gray-200 text-gray-900 font-semibold' : 'text-gray-700 hover:bg-gray-50' }}">
                    Offre De Service
                </a>
                <a href="/admin/contacts"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg
              {{ request()->is('admin/contacts*') ? 'bg-gray-200 text-gray-900 font-semibold' : 'text-gray-700 hover:bg-gray-50' }}">
                    Contacts
                </a>
            </nav>


            {{-- Visit Site --}}
            <div class="mt-auto">
                <a href="/" target="_blank" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-xl shadow">
                    🌐 Consulter votre Site Web
                </a>
            </div>
        </aside>

        {{-- Main Content --}}
        <main class="w-full pt-10 px-2 md:px-10 transition-all duration-300 ml-0 md:ml-64">
            @yield('content')
        </main>

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const sidebar = document.getElementById("sidebar");
            const sidebarOpen = document.getElementById("sidebar-open");
            const sidebarClose = document.getElementById("sidebar-close");
            const overlay = document.getElementById("sidebar-overlay");

            sidebarOpen.addEventListener("click", () => {
                sidebar.classList.remove("-translate-x-full");
                overlay.classList.remove("hidden");
            });

            sidebarClose.addEventListener("click", () => {
                sidebar.classList.add("-translate-x-full");
                overlay.classList.add("hidden");
            });

            overlay.addEventListener("click", () => {
                sidebar.classList.add("-translate-x-full");
                overlay.classList.add("hidden");
            });
        });
    </script>
</body>

</html>