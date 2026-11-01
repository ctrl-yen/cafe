<x-guest-layout>
    <h1 class="text-2xl font-semibold">Inloggen</h1>

    <x-auth-session-status class="mt-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-4">
        @csrf

        <div>
            <x-input-label for="email" value="E-mailadres" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" value="Wachtwoord" />
            <x-text-input id="password" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <label for="remember_me" class="flex items-center gap-2">
            <input id="remember_me" type="checkbox" name="remember" class="rounded border-cream-300 text-sage-600 focus:ring-sage-400">
            <span class="text-sm">Onthoud mij</span>
        </label>

        <x-primary-button class="w-full">Inloggen</x-primary-button>

        <p class="text-sm">
            Nog geen account? <a href="{{ route('register') }}" class="link">Registreren</a>
        </p>
    </form>
</x-guest-layout>
