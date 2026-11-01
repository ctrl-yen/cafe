{{-- Navbar: links de site, rechts Inloggen/Registreren (gast) of profielfoto + naam met dropdown (ingelogd) --}}
<nav class="bg-sage-700 text-cream-50">
    <div class="container-cozy flex flex-wrap items-center justify-between gap-4 py-3">
        <div class="flex items-center gap-6">
            <a href="{{ route('home') }}" class="text-xl font-bold">Cafe Society</a>
            <a href="{{ route('cafes.index') }}" class="hover:underline">Cafés</a>
        </div>

        <div class="flex items-center gap-4">
            @guest
                <a href="{{ route('login') }}" class="hover:underline">Inloggen</a>
                <a href="{{ route('register') }}" class="hover:underline">Registreren</a>
            @endguest

            @auth
                {{-- x-dropdown is een Breeze-component; het open/dicht klikken doet Alpine.js --}}
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center gap-2 rounded-full py-1 pl-1 pr-3 hover:bg-sage-600 transition">
                            {{-- Profielfoto: voorlopig de eerste letter van je naam --}}
                            <span class="grid h-9 w-9 place-items-center rounded-full bg-cream-100 font-bold text-sage-700">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </span>
                            <span class="font-semibold">{{ Auth::user()->name }}</span>
                            <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('dashboard')">Dashboard</x-dropdown-link>
                        <x-dropdown-link :href="route('profile.edit')">Mijn profiel</x-dropdown-link>

                        @can('admin')
                            <x-dropdown-link :href="route('admin.users')">Gebruikers beheren</x-dropdown-link>
                        @endcan

                        {{-- Uitloggen moet een POST zijn (met @csrf), daarom een formulier --}}
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                Uitloggen
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            @endauth
        </div>
    </div>
</nav>
