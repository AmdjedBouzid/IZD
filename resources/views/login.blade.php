<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="{{ Storage::url( $metadata->website_logo_path ) }}" type="image/png">
    @vite('resources/css/app.css')
</head>
<body>
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
    
                    <button
                        type="submit"
                        class="mt-4 w-full bg-primary text-white font-semibold py-3 rounded-xl shadow hover:opacity-90 transition cursor-pointer">
                        Se connecter
                    </button>
                </form>
            </div>
                @if(session()->has('success'))
    <x-toast-success message="{{ session('success') }}" />
@endif
@if(session()->has('error'))
    <x-toast-error message="{{ session('error') }}" />
@endif
        </div>
</body>