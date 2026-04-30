<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Novo Contato</h2>
    </x-slot>

    @include('contacts._errors')
    
    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded p-6 flex flex-col">
            <form action="{{ route('contacts.store') }}" method="POST" class="items-end justify-end text-right">
                @csrf

                @include('contacts._form')

                <button type="submit" class="mt-4 bg-blue-600 text-white px-6 py-1 rounded">
                    Salvar
                </button>
            </form>
        </div>

        <a href="{{ route('contacts.index') }}" class="text-blue-600 hover:underline block pt-2 mt-4">← Voltar</a>
    </div>
</x-app-layout>