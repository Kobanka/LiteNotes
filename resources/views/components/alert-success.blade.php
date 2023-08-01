@if (session('success'))
    <div class="mb-4 rounded-md bg-green-100 text-green-700 border border-green-200 px-4 py-2">
        {{ $slot }}
    </div>
@endif