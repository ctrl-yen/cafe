<x-app-layout>
    <div class="container-cozy py-10">
        <h1 class="text-3xl font-semibold">Dashboard</h1>
        <p class="mt-2">Hoi {{ Auth::user()->name }}, je bent ingelogd.</p>
    </div>
</x-app-layout>
