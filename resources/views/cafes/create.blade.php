{{--
    Formulier om een café toe te voegen (route: GET /cafes/create)
    Verwacht vanuit de controller: $categories (voor de dropdown)
    Verstuurt naar: CafeController@store (POST /cafes)
    De name="..." van elk veld is gelijk aan de kolomnaam in de cafes-tabel.
--}}
<x-app-layout>
    <div class="container-cozy py-10">
        <a href="{{ route('cafes.index') }}" class="link text-sm">← Terug naar cafés</a>
        <h1 class="mt-2 text-3xl font-semibold">Café toevoegen</h1>

        <form method="POST" action="{{ route('cafes.store') }}" class="mt-6 card p-6 max-w-xl space-y-5">
            @csrf

            <div>
                <label for="name" class="label">Naam</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" class="input" placeholder="Bijv. Bonjour Koffie">
                @error('name')
                    <p class="mt-1 text-sm text-red-700">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="city" class="label">Stad</label>
                <input id="city" type="text" name="city" value="{{ old('city') }}" class="input" placeholder="Bijv. Rotterdam">
                @error('city')
                    <p class="mt-1 text-sm text-red-700">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="category_id" class="label">Categorie</label>
                <select id="category_id" name="category_id" class="input">
                    <option value="">Kies een categorie</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="mt-1 text-sm text-red-700">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-primary">Opslaan</button>
                <a href="{{ route('cafes.index') }}" class="btn-outline">Annuleren</a>
            </div>
        </form>
    </div>
</x-app-layout>
