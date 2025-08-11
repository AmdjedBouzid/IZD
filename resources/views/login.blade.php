    @vite('resources/css/app.css')
    <div class="min-h-screen flex items-center justify-center bg-gray-50 px-4">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">
            <h2 class="text-3xl font-bold text-center text-gray-900 mb-6">
                Bienvenue
            </h2>

            {{-- Form that redirects to / --}}
            <form action="{{ url('/admin/metadata') }}" method="GET" class="space-y-5">
                <div>
                    <label for="identifier" class="block text-sm font-medium text-gray-700">
                        Nom d'utilisateur ou Email
                    </label>
                    <input
                        type="text"
                        name="identifier"
                        id="identifier"
                        class="mt-1 block w-full rounded-xl border border-gray-300 shadow-sm p-3 focus:ring-primary focus:border-primary"
                        placeholder="Entrez votre nom d'utilisateur ou email"
                        required>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">
                        Mot de passe
                    </label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="mt-1 block w-full rounded-xl border border-gray-300 shadow-sm p-3 focus:ring-primary focus:border-primary"
                        placeholder="Entrez votre mot de passe"
                        required>
                </div>

                <button
                    type="submit"
                    class="w-full bg-primary text-white font-semibold py-3 rounded-xl shadow hover:opacity-90 transition cursor-pointer">
                    Se connecter
                </button>
            </form>
        </div>
    </div>