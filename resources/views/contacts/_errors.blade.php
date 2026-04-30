@if ($errors->any())
    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="sm:px-6 lg:px-8 py-4 bg-red-100 text-red-700 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif