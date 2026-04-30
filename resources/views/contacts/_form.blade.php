<table class="min-w-full divide-y divide-gray-200">
    <tbody class="bg-white divide-gray-200">
        <tr>
            <td class="py-2 px-4 w-48">
                <label class="block text-sm font-medium text-gray-700">Nome:</label>
            </td>
            <td class="py-2">
                <input type="text" name="name" value="{{ old('name', $contact->name ?? '') }}" minlength="5" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </td>
        </tr>
        <tr>
            <td class="py-2 px-4 w-48">
                <label class="block text-sm font-medium text-gray-700">Contato:</label>
            </td>
            <td class="py-2">
                <input type="tel" name="contact" value="{{ old('contact', $contact->contact ?? '') }}" minlength="9" maxlength="9"
                    required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </td>
        </tr>
        <tr>
            <td class="py-2 px-4 w-48">
                <label class="block text-sm font-medium text-gray-700">E-mail:</label>
            </td>
            <td class="py-2">
                <input type="email" name="email" value="{{ old('email', $contact->email ?? '') }}" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </td>
        </tr>
    </tbody>
</table>