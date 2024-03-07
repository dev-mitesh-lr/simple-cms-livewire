<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="py-12">

                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <nav class="bg-gray-100 p-4">
                        <ol class="list-none p-0 inline-flex">
                            <li class="flex items-center">
                                <a href="{{ route('page.list') }}"
                                    class="text-gray-500 hover:text-blue-500 transition duration-300">Home</a>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-2 fill-current text-gray-400"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 0 1 1.414 0L10 10.586l3.293-3.293a1 1 0 1 1 1.414 1.414l-4 4a1 1 0 0 1-1.414 0l-4-4a1 1 0 0 1 0-1.414zM10 4a1 1 0 0 1 1 1v5.586l1.293-1.293a1 1 0 1 1 1.414 1.414l-3 3a1 1 0 0 1-1.414 0l-3-3a1 1 0 0 1 1.414-1.414L9 10.586V5a1 1 0 0 1 1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                            </li>

                            @foreach ($this->breadcrumb as $breadcrumb)
                                @if ($loop->last)
                                    <li class="flex items-center">
                                        <span class="text-gray-800">{{ Str::title($breadcrumb) }}</span>
                                    </li>
                                @else
                                    <li class="flex items-center">
                                        <a href="{{ route('page.show', $breadcrumb) }}"
                                            class="text-gray-500 hover:text-blue-500 transition duration-300">{{ Str::title($breadcrumb) }}</a>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5 mx-2 fill-current text-gray-400" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 0 1 1.414 0L10 10.586l3.293-3.293a1 1 0 1 1 1.414 1.414l-4 4a1 1 0 0 1-1.414 0l-4-4a1 1 0 0 1 0-1.414zM10 4a1 1 0 0 1 1 1v5.586l1.293-1.293a1 1 0 1 1 1.414 1.414l-3 3a1 1 0 0 1-1.414 0l-3-3a1 1 0 0 1 1.414-1.414L9 10.586V5a1 1 0 0 1 1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </li>
                                @endif
                            @endforeach


                        </ol>
                    </nav>
                    <div class=" overflow-hidden  sm:rounded-lg">

                        <div class="container mx-auto py-8">
                            @if ($page)
                                <h1 class="text-3xl font-bold">{{ $page->title }}</h1>
                                <p class="mt-4 text-gray-700">{!! $page->content  !!}</p>

                                @if ($page->children->count() > 0)
                                    <h2 class="mt-8 text-xl font-bold">Subpages:</h2>
                                    <ul class="mt-4 list-disc list-inside">
                                        @foreach ($page->children as $childPage)
                                            <li class="mb-2">
                                                <a href="{{ url(route('page.show', ['slug' => $page->getPath($childPage)])) }}"
                                                    class="text-blue-600 hover:underline">{{ $childPage->title }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            @else
                                <p class="mt-4 text-red-500">Page not found</p>
                            @endif
                        </div>



                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
