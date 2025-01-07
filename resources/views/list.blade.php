<x-layout>
    <div class="bg-white">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 sm:py-4 lg:px-8">
            @if(isset($categories))
                <!-- Render all categories and their products -->
                @foreach($categories as $category)
                    <div class="mb-8">
                        <!-- Category Name -->
                        <h2 class="text-2xl font-semibold text-primary mb-4">{{ $category->name }}</h2>
                        
                        <!-- Products of the Category -->
                        <div class="grid grid-cols-5 gap-x-6 gap-y-10 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
                            @foreach($category->products as $product)
                                <a href="/product/{{ $product->id }}" class="group">
                                    <div class="w-52 h-52 overflow-hidden rounded-lg bg-gray-200">
                                        <img src="{{ asset('storage/' . $product->thumbnail->path) }}" 
                                             alt="{{ $product->title }}"
                                             class="h-full w-full object-cover object-center group-hover:opacity-75">
                                    </div>
                                    <h3 class="mt-4 text-sm text-gray-700">{{ $product->title }}</h3>
                                    <p class="mt-1 text-lg font-medium text-gray-900">{{ number_format($product->price, 0, ',', '.') }}</p>
                                </a>
                            @endforeach
                        </div>

                        <!-- Section Break -->
                        <div class="border-t-2 border-primary my-8"></div>
                    </div>
                @endforeach
            @elseif(isset($category))
                <!-- Render specific category and its products -->
                <div class="mb-8">
                    <!-- Category Name -->
                    <h2 class="text-2xl font-semibold text-primary mb-4">{{ $category->name }}</h2>
                    
                    <!-- Products of the Category -->
                    <div class="grid grid-cols-5 gap-x-6 gap-y-10 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
                        @foreach($category->products as $product)
                            <a href="/product/{{ $product->id }}" class="group">
                                <div class="w-52 h-52 overflow-hidden rounded-lg bg-gray-200">
                                    <img src="{{ asset('storage/' . $product->thumbnail->path) }}" 
                                         alt="{{ $product->title }}"
                                         class="h-full w-full object-cover object-center group-hover:opacity-75">
                                </div>
                                <h3 class="mt-4 text-sm text-gray-700">{{ $product->title }}</h3>
                                <p class="mt-1 text-lg font-medium text-gray-900">{{ number_format($product->price, 0, ',', '.') }}</p>
                            </a>
                        @endforeach
                    </div>
                </div>
            @else
                <p class="text-center text-gray-500">No categories or products found.</p>
            @endif
        </div>
    </div>  
</x-layout>