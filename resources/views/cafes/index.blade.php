{{--
    Overzicht van alle cafés (route: /cafes)
    Verwacht vanuit de controller:
      $cafes      -> gepagineerde cafés (met category en reviews_count)
      $categories -> alle categorieën (voor de dropdown)
      $cities     -> lijst met unieke steden (voor de dropdown)
--}}
<x-app-layout>
    <div class="container-cozy py-10">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <h1 class="text-3xl font-semibold">Cafés</h1>
                <p class="mt-1 text-espresso-700">Aantal gevonden cafés: {{ $cafes->total() }}</p>
            </div>

            @can('admin')
                <a href="{{ route('cafes.create') }}" class="btn-primary">+ Café toevoegen</a>
            @endcan
        </div>

        {{-- Filter-formulier: method GET, dus de filters komen in de URL (?search=...&city=...) --}}
        <form action="{{ url('/cafes') }}" method="GET" class="mt-6 card p-4 grid gap-4 sm:grid-cols-2 lg:grid-cols-4 items-end">
            <div class="lg:col-span-2">
                <label for="search" class="label">Zoeken</label>
                <input id="search" type="text" name="search" value="{{ request('search') }}" class="input" placeholder="Naam of stad...">
            </div>

            <div>
                <label for="city" class="label">Stad</label>
                <select id="city" name="city" class="input">
                    <option value="">Alle steden</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city }}" @selected(request('city') == $city)>{{ $city }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="category" class="label">Categorie</label>
                <select id="category" name="category" class="input">
                    <option value="">Alle categorieën</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(request('category') == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>


            <div class="sm:col-span-2 lg:col-span-4 flex gap-3">
                <button type="submit" class="btn-primary">Filteren</button>
                <a href="{{ url('/cafes') }}" class="btn-outline">Reset</a>
            </div>
        </form>

        {{-- Tegels --}}
        @if ($cafes->isEmpty())
            <p class="mt-10 text-espresso-700">Geen cafés gevonden. Probeer een ander filter.</p>
        @else
            <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($cafes as $cafe)
                    <div class="card overflow-hidden">
                        @if ($cafe->image)
                            <img src="{{ asset('storage/' . $cafe->image) }}" alt="{{ $cafe->name }}" class="h-44 w-full object-cover">
                        @else
                            <div class="h-44 w-full bg-sage-100 grid place-items-center text-5xl">☕</div>
                        @endif

                        <div class="p-4">
                            <h2 class="text-lg font-semibold">
                                <a href="{{ route('cafes.show', $cafe) }}" class="hover:underline">{{ $cafe->name }}</a>
                            </h2>

                            <p class="text-sm text-espresso-700">{{ $cafe->city }}</p>

                            <div class="mt-3 flex items-center justify-between text-sm">
                                <span class="rounded bg-sage-100 px-2 py-0.5 text-sage-800">{{ $cafe->category->name }}</span>
                                <span class="text-espresso-700">{{ $cafe->reviews_count }} reviews</span>
                            </div>

                            @can('admin')
                                <form method="POST" action="{{ route('cafes.destroy', $cafe) }}" onsubmit="return confirm('Weet je zeker dat je dit café wilt verwijderen?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm text-red-700 hover:underline">Verwijderen</button>
                                </form>
                            @endcan
                        </div>
                    </div>


                @endforeach
            </div>

            <div class="mt-8">
                {{ $cafes->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
