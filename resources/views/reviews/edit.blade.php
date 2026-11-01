<x-app-layout>
    <div class="container-cozy py-10">
        <a href="{{ route('cafes.show', $review->cafe_id) }}" class="link text-sm">← Terug naar het café</a>
        <h1 class="mt-2 text-3xl font-semibold">Review bewerken</h1>

        <form method="POST" action="{{ route('reviews.update', $review) }}" class="mt-6 card p-6 max-w-xl space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="body" class="label">Jouw review</label>
                <textarea id="body" name="body" rows="5" class="input">{{ old('body', $review->body) }}</textarea>
                @error('body')
                <p class="mt-1 text-sm text-red-700">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3">
                <button type="submit" class="btn-primary">Opslaan</button>
                <a href="{{ route('cafes.show', $review->cafe_id) }}" class="btn-outline">Annuleren</a>
            </div>
        </form>
    </div>
</x-app-layout>
