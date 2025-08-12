    @vite('resources/css/app.css')
    <div class="min-h-screen flex items-center justify-center bg-gray-50 px-4">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">
            <h2 class="text-3xl font-bold text-center text-gray-900 mb-6">
                Bienvenue
            </h2>

            {{-- Form that redirects to / --}}
            <form method="POST" action="{{ route('login') }}" ">
                @csrf
                <div>
                    <label for="identifier" class="block text-sm font-medium text-gray-700">
                        Nom d'utilisateur ou Email
                    </label>
                    <input
                        type="text"
                        name="email" 
                        :value="old('email')"
                        id="identifier"
                        class="mt-1 block w-full rounded-xl border border-gray-300 shadow-sm p-3 focus:ring-primary focus:border-primary"
                        placeholder="Entrez votre nom d'utilisateur ou email"
                        required>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">
                        Mot de passe
                    </label>
                    <input
                        type="password"
                        name="password"
                        required autocomplete="current-password"
                        id="password"
                        class="mt-1 block w-full rounded-xl border border-gray-300 shadow-sm p-3 focus:ring-primary focus:border-primary"
                        placeholder="Entrez votre mot de passe"
                        required>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                        <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <button
                    type="submit"
                    class="mt-4 w-full bg-primary text-white font-semibold py-3 rounded-xl shadow hover:opacity-90 transition cursor-pointer">
                    Se connecter
                </button>
            </form>
        </div>
    </div>