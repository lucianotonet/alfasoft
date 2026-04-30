<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detalhes do Contato</h2>

            @auth
                <div class="flex gap-4 justify-end">
                    <a href="{{ route('contacts.edit', $contact) }}"
                        class="text-yellow-600 hover:text-yellow-800 py-1 px-2 hover:underline">Editar</a>

                    <form action="{{ route('contacts.destroy', $contact) }}" method="POST"
                        onsubmit="return confirm('Tem certeza que deseja excluir o contato {{ $contact->name }}?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-4 py-1 rounded">Excluir</button>
                    </form>
                </div>
            @endauth
        </div>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="">
            <table class="min-w-full divide-y divide-gray-200">
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4"><span class="font-semibold">ID:</span></td>
                        <td class="px-6 py-4 w-full">{{ $contact->id }}</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4"><span class="font-semibold">Nome:</span></td>
                        <td class="px-6 py-4 w-full">{{ $contact->name }}</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4"><span class="font-semibold">Contato:</span></td>
                        <td class="px-6 py-4 w-full">{{ $contact->contact }}</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4"><span class="font-semibold">E-mail:</span></td>
                        <td class="px-6 py-4 w-full">{{ $contact->email }}</td>
                    </tr>
                </tbody>
            </table>

            <a href="{{ route('contacts.index') }}" class="text-blue-600 hover:underline block pt-2 mt-4">← Voltar</a>
        </div>
    </div>
</x-app-layout>