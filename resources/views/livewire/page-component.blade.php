<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pages') }}
        </h2>
    </x-slot>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('message') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <title>Close</title>
                    <path
                        d="M14.348 5.652a.5.5 0 0 1 .707 0l.707.707a.5.5 0 0 1 0 .707l-6.364 6.364a.5.5 0 0 1-.707 0l-.707-.707a.5.5 0 0 1 0-.707l6.364-6.364zm-8.284 0a.5.5 0 0 0-.707 0L4.95 6.36a.5.5 0 0 0 0 .707l6.364 6.364a.5.5 0 0 0 .707 0l.707-.707a.5.5 0 0 0 0-.707l-6.364-6.364z" />
                </svg>
            </span>
        </div>
    @endif


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="overflow-hidden sm:rounded-lg">
                            <h>{{ $this->pageId ? 'Edit' : 'Add' }} Page</h>
                            <div class="p-6">
                                <form method="POST" wire:submit.prevent="submitForm({{ $this->page->id ?? null }})">
                                    @csrf

                                    <!-- Title -->
                                    <div class="mb-4">
                                        <label for="title"
                                            class="block text-sm font-medium text-gray-700">Title</label>
                                        <input type="text" wire:model='title' name="title" id="title"
                                            class="mt-1 p-2 block w-full border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            autofocus />
                                        @error('title')
                                            <span class="text-red-500 text-xs italic">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <!-- Slug -->
                                    <div class="mb-4">
                                        <label for="slug"
                                            class="block text-sm font-medium text-gray-700">Slug</label>
                                        <input type="text" wire:model='slug' name="slug" id="slug"
                                            class="mt-1 p-2 block w-full border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            autofocus />
                                        @error('slug')
                                            <span class="text-red-500 text-xs italic">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <!-- Parent Page -->
                                    <div class="mb-4">
                                        <label for="parent_id" class="block text-sm font-medium text-gray-700">Parent
                                            Page</label>
                                        <select wire:model='parentId' name="parent_id" id="parent_id"
                                            class="mt-1 p-2 block w-full border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value="">Select Parent Page</option>
                                            {!! renderOptions($this->pages, 0, $this->parentId) !!}
                                        </select>
                                        @error('parentId')
                                            <span class="text-red-500 text-xs italic">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="mb-4">
                                        <div wire:ignore>
                                            <label for="content"
                                                class="block text-sm font-medium text-gray-700">Content</label>
                                            <textarea id="summernote" name="content"
                                                class="mt-1 p-2 block w-full border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                                rows="6">{{ $this->content }}</textarea>
                                        </div>
                                        @error('content')
                                            <span class="text-red-500 text-xs italic">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="flex items-center justify-end mt-4">
                                        <button type="submit"
                                            class="ml-4 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Save
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>

    <script>
        document.addEventListener('livewire:load', function() {
            var summernoteEditor = $('#summernote');

            summernoteEditor.summernote({
                tabsize: 2,
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['table', ['table']],
                    ['insert', ['link', 'hr']],
                    ['help', ['help']]
                ],
                callbacks: {
                    onChange: function(contents, $editable) {
                        @this.set('content', contents);
                    }
                }
            });

            summernoteEditor.on('summernote.change', function(_, contents) {
                @this.set('content', contents);
            });

            @this.on('contentUpdated', function() {
                summernoteEditor.summernote('code', @this.get('content'));
            });
        });


        
    </script>
@endpush
