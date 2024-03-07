<div class="py-12">
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('message') }}</span>

        </div>
    @endif
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <a href="{{ route('page.create') }}"
            class="mb-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path
                    d="M13 10a2 2 0 11-4 0 2 2 0 014 0zm-8-5a1 1 0 011-1h10a1 1 0 110 2H6a1 1 0 01-1-1zm0 4a1 1 0 011-1h4a1 1 0 110 2H6a1 1 0 01-1-1zm0 4a1 1 0 011-1h2a1 1 0 110 2H6a1 1 0 01-1-1z" />
            </svg>
            Add Page
        </a>

        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class=" overflow-hidden  sm:rounded-lg">

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left  font-medium text-gray-500 uppercase tracking-wider">
                                            ID</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left  font-medium text-gray-500 uppercase tracking-wider">
                                            Title</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left  font-medium text-gray-500 uppercase tracking-wider">
                                            Slug</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left  font-medium text-gray-500 uppercase tracking-wider">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">

                                    @if ($this->pages)
                                        @foreach ($this->pages as $page)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $page->id }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $page->title }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $page->slug }}</td>
                                                <td class="px-6 py-4 whitespace-wrap">
                                                    <button
                                                        class="mr-3 bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded inline-flex items-center"
                                                        wire:click="confirmDelete({{ $page->id }})">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2"
                                                            viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd"
                                                                d="M14.707 2.293a1 1 0 011.414 1.414L6.414 15.414a1 1 0 01-1.414-1.414L14.707 2.293zM2.293 5.707a1 1 0 011.414-1.414L15.414 13.586a1 1 0 01-1.414 1.414L2.293 5.707z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        Delete
                                                    </button>

                                                    <a href="{{ route('page.update', $page->id) }}"
                                                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2"
                                                            viewBox="0 0 20 20" fill="currentColor">
                                                            <path
                                                                d="M13 10a2 2 0 11-4 0 2 2 0 014 0zm-8-5a1 1 0 011-1h10a1 1 0 110 2H6a1 1 0 01-1-1zm0 4a1 1 0 011-1h4a1 1 0 110 2H6a1 1 0 01-1-1zm0 4a1 1 0 011-1h2a1 1 0 110 2H6a1 1 0 01-1-1z" />
                                                        </svg>
                                                        Edit
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <h1>No Data</h1>
                                    @endif


                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Blade template code -->
    <div  class="@if(!$deleteId) hidden @endif" >
        <!-- Modal -->
        <div x-show="showModal" class="fixed inset-0 flex items-center justify-center z-50">
            <!-- Background overlay -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-50 transition-opacity"></div>

            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                <!-- Modal content -->
                <div class="px-4 py-5 sm:p-6">
                    <!-- Modal title -->
                    <div class="sm:flex sm:items-center sm:justify-between">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Are you sure want to
                            delete this record?</h3>

                    </div>
                </div>

                <!-- Modal footer -->
                <div class="bg-ignore-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button @click="showModal = false" type="button" wire:click='hideModal()'
                        class="mr-3 bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                        Cancel
                    </button>
                    <button @click="showModal = false" type="button" wire:click='deletePage({{$this->deleteId}})'
                        class="mr-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                        Ok
                    </button>
                </div>
            </div>
        </div>
    </div>


</div>
