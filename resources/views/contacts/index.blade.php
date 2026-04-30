<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Contatos</h2>

            @auth
                <a href="{{ route('contacts.create') }}" class="bg-blue-600 text-white px-4 py-1 rounded">
                    + Novo Contato
                </a>
            @endauth
        </div>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
        @endif

        <div class="bg-white shadow rounded overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nome</th>
                        @auth
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Ações</th>
                        @endauth
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($contacts as $contact)
                        <tr>
                            <td class="px-6 py-4">
                                <a href="{{ route('contacts.show', $contact) }}" class="text-blue-600 hover:underline">
                                    {{ $contact->name }}
                                </a>
                            </td>

                            @auth
                                <td class="px-6 py-4 flex gap-2 justify-end">
                                    <a href="{{ route('contacts.edit', $contact) }}"
                                        class="text-yellow-600 hover:underline">Editar</a>

                                    <form action="{{ route('contacts.destroy', $contact) }}" method="POST"
                                        onsubmit="return confirm('Tem certeza que deseja excluir o contato {{ $contact->name }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Excluir</button>
                                    </form>
                                </td>
                            @endauth
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">Nenhum contato encontrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $contacts->links() }}</div>
    </div>
</x-app-layout>