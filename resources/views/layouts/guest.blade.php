{{-- Layout voor login / register / wachtwoord vergeten --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.partials.head')
    </head>
    <body>
        @include('layouts.navigation')

        <main class="px-4 py-16">
            <div class="mx-auto max-w-md card p-8">
                {{ $slot }}
            </div>
        </main>
    </body>
</html>
