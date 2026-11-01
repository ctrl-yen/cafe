<x-app-layout>
    <div class="container-cozy py-10">
        <h1 class="text-3xl font-semibold">Gebruikers beheren</h1>

        <div class="mt-6 card overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-sage-100 text-sage-800">
                <tr>
                    <th class="p-3">Naam</th>
                    <th class="p-3">E-mail</th>
                    <th class="p-3">Rol</th>
                    <th class="p-3">Status</th>
                    <th class="p-3"></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr class="border-t border-cream-300">
                        <td class="p-3">{{ $user->name }}</td>
                        <td class="p-3">{{ $user->email }}</td>
                        <td class="p-3">{{ $user->role }}</td>
                        <td class="p-3">
                            @if ($user->is_active)
                                <span class="text-sage-700 font-semibold">Actief</span>
                            @else
                                <span class="text-red-700 font-semibold">Inactief</span>
                            @endif
                        </td>
                        <td class="p-3">
                            <form method="POST" action="{{ route('admin.users.toggle', $user) }}">
                                @csrf
                                <button type="submit" class="btn-outline">
                                    {{ $user->is_active ? 'Deactiveren' : 'Activeren' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
