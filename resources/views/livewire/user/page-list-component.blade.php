
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class=" overflow-hidden  sm:rounded-lg">
                        <h1>Page List</h1>
                        <div class="container mx-auto py-8">
                            <ul class="mt-4 list-disc list-inside">
                                @foreach ($this->pages as $page)
                                    <li class="mb-2">
                                        <a href="{{ url(route('page.show', ['slug' => $page->slug])) }}" class="text-blue-600 hover:underline">{{ $page->title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>