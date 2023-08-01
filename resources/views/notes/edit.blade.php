<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Note') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('notes.update', $note) }}" method="post">
                @method('put')
                @csrf
                <x-text-input 
                type="text" 
                name="title" 
                field="title" 
                class="w-full" 
                placeholder="Your note title..." 
                autocomplete="off"
                :value="@old('title', $note->title)"></x-text-input>

                <x-textarea 
                name="text" 
                field="text" 
                rows="10" 
                class="w-full mt-6" 
                placeholder="Start typing your text here...."
                :value="@old('text', $note->text)"></x-textarea>
                <x-primary-button class="mt-6">Save Note</x-primary-button>
               
            </form>
        </div>
    </div>
</x-app-layout>