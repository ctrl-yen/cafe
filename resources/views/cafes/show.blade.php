<x-app-layout>
    <div class="container-cozy py-10">
        <a href="{{ route('cafes.index') }}" class="link text-sm">← Terug naar cafés</a>

        {{-- Info over het café --}}
        <div class="mt-4 card p-6">
            <h1 class="text-3xl font-semibold">{{ $cafe->name }}</h1>
            <p class="mt-1 text-espresso-700">{{ $cafe->city }}</p>
            <span class="mt-3 inline-block rounded bg-sage-100 px-2 py-0.5 text-sm text-sage-800">
                {{ $cafe->category->name }}
            </span>
        </div>

        {{-- Reviews --}}
        <h2 class="mt-10 text-2xl font-semibold">Reviews ({{ $cafe->reviews->count() }})</h2>

        @forelse ($cafe->reviews as $review)
            <div class="mt-4 card p-5">
                <p>{{ $review->body }}</p>
                <p class="mt-2 text-sm text-espresso-700">
                    {{ $review->user->name }} · {{ $review->created_at->format('d-m-Y') }}
                </p>

                @can('update-review', $review)
                    <a href="{{ route('reviews.edit', $review) }}" class="mt-2 inline-block text-sm link">Bewerken</a>
                @endcan

                @can('delete-review', $review)
                    <form method="POST" action="{{ route('reviews.destroy', $review) }}" class="mt-2" onsubmit="return confirm('Review verwijderen?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-sm text-red-700 hover:underline">Verwijderen</button>
                    </form>
                @endcan
            </div>

        @empty
            <p class="mt-4 text-espresso-700">Nog geen reviews voor dit café.</p>
        @endforelse

        {{-- Review schrijven --}}
        <h2 class="mt-10 text-2xl font-semibold">Schrijf een review</h2>

        @auth
            <form method="POST" action="{{ route('reviews.store', $cafe) }}" class="mt-4 card p-5 space-y-4">
                @csrf

                <div>
                    <label for="body" class="label">Jouw review</label>
                    <textarea id="body" name="body" rows="4" class="input">{{ old('body') }}</textarea>
                    @error('body')
                    <p class="mt-1 text-sm text-red-700">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn-primary">Plaatsen</button>
            </form>
        @else
            <p class="mt-4 text-espresso-700">
                <a href="{{ route('login') }}" class="link">Log in</a> om een review te schrijven.
            </p>
        @endauth
    </div>
</x-app-layout>
