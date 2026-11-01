{{-- Homepage (route: '/') --}}
<x-app-layout>
    <div class="container-cozy py-16">
        <h1 class="text-4xl font-semibold">Welkom bij Cafe Society</h1>
        <p class="mt-4 max-w-2xl text-lg text-espresso-700">
            Ontdek de gezelligste cafés van Nederland, lees reviews van andere koffieliefhebbers
            en deel je eigen favoriete plekjes.
        </p>

        <a href="{{ url('/cafes') }}" class="mt-8 btn-primary">Bekijk alle cafés</a>
    </div>



</x-app-layout>
