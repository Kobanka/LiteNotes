<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ !$note->trashed() ? __('Notes') : __('Trash') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert-success>
                {{ session('success') }}
            </x-alert-success>
            <div class="flex mb-6">
                @if (!$note->trashed())
                    <p class="opacity-70">
                        <strong>Created: </strong>{{ $note->created_at->diffForHumans() }}
                    </p>
                    <p class="opacity-70 ml-8">
                        <strong>Updated: </strong>{{ $note->updated_at->diffForHumans() }}
                    </p>
                    <a href="{{ route('notes.edit', $note) }}" class="btn-link ml-auto">Edit Note</a>
                    <form action="{{ route('notes.destroy', $note) }}" method="post">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger ml-4" onclick="confirm('Are you sure to move this note to the trash ?')">Move to Trash</button>
                    </form>
                @else
                    <p class="opacity-70">
                        <strong>Deleted: </strong>{{ $note->deleted_at->diffForHumans() }}
                    </p>
                    <form action="{{ route('trashed.update', $note) }}" method="post" class="ml-auto">
                        @method('put')
                        @csrf

                        <button type="submit" class="btn-link">Restore Note</button>
                    </form>

                    <form action="{{ route('trashed.destroy', $note) }}" method="post">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger ml-4" onclick="confirm('Are you sure to delete this note permanently ? This action is irreversible !')">Delete permanently</button>
                    </form>
                @endif
            </div>
            <div class="bg-white p-6 mb-6 border-b border-gray-200 overflow-hidden shadow-sm sm:rounded-lg">
                <h2 class="font-bold text-4xl">{{ $note->title }}</h2>
                <p class="mt-6 whitespace-pre-wrap">{{ $note->text }}</p>
            </div>
        </div>
    </div>
</x-app-layout>