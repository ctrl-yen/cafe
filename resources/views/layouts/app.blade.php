{{-- Hoofd-layout. Gebruik in een view: <x-app-layout> ... </x-app-layout> --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.partials.head')
    </head>
    <body>
        @include('layouts.navigation')

        @isset($header)
            <header class="container-cozy pt-10">
                {{ $header }}
            </header>
        @endisset

        <main>
            {{ $slot }}
        </main>
    </body>
</html>
