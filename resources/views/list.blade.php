<x-layout>
    <div class="bg-white">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 sm:py-4 lg:px-8">
            @if(isset($categories))
                <div class="mb-8">
                    <input type="text" id="global-search" placeholder="Search for products..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:outline-none">
                </div>
                <!-- Render all categories and their products -->
                @foreach($categories as $category)
                    <div class="mb-8" data-category-id="{{ $category->id }}">
                        <h2 class="text-2xl font-bold text-primary mb-4 text-center">{{ $category->name }}</h2>
                        <div class="grid grid-cols-5 gap-x-6 gap-y-10 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 product-container">
                            @foreach($category->products as $product)
                                <a href="/product/{{ $product->id }}" 
                                   class="group flex flex-col items-center text-center">
                                    <div class="w-52 h-52 flex items-center justify-center overflow-hidden rounded-lg bg-gray-200">
                                        <img src="{{ asset('storage/' . $product->thumbnail->path) }}" alt="{{ $product->title }}" class="h-full w-full object-cover object-center group-hover:opacity-75">
                                    </div>
                                    <p class="mt-4 text-xl font-semibold text-primary w-full break-words line-clamp-2 h-16">{{ $product->title }}</p>
                                    <p class="mt-2 text-lg font-medium text-primary">{{ formatRupiah($product->price) }}</p>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endforeach

            @elseif(isset($category))
                <div class="mb-8">
                    <input type="text" id="category-search" data-category-id="{{ $category->id }}" placeholder="Search in {{ $category->name }}..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:outline-none">
                </div>
                <!-- Render specific category and its products -->
                <div class="mb-8" data-category-id="{{ $category->id }}">
                    <h2 class="text-2xl font-bold text-primary mb-4 text-center">{{ $category->name }}</h2>
                    <div class="grid grid-cols-5 gap-x-6 gap-y-10 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 product-container">
                        @foreach($category->products as $product)
                            <a href="/product/{{ $product->id }}" class="group flex flex-col items-center text-center">
                                <div class="w-52 h-52 flex items-center justify-center overflow-hidden rounded-lg bg-gray-200">
                                    <img src="{{ asset('storage/' . $product->thumbnail->path) }}" alt="{{ $product->title }}" class="h-full w-full object-cover object-center group-hover:opacity-75">
                                </div>
                                <p class="mt-4 text-xl font-semibold text-primary w-full break-words line-clamp-2 h-16">{{ $product->title }}</p>
                                <p class="mt-2 text-lg font-medium text-primary">{{ formatRupiah($product->price) }}</p>
                            </a>
                        @endforeach
                    </div>
                </div>
            @else
                <p class="text-center text-gray-500">No categories or products found.</p>
            @endif
        </div>
    </div> 

    <script>
document.addEventListener('DOMContentLoaded', () => {
    const globalSearchInput = document.getElementById('global-search');
    const categorySearchInputs = document.querySelectorAll('#category-search');

    // Function to dynamically render products
    const renderProducts = (products, productContainer, searchQuery, isGlobal = false) => {    
        console.log('productContainer:', productContainer);
        const parentCategoryDiv = productContainer.closest('[data-category-id]');
        console.log('parentCategoryDiv:', parentCategoryDiv);
        console.log(isGlobal);
        if (parentCategoryDiv) {
            // Update the heading dynamically
            const heading = parentCategoryDiv.querySelector('h2');
            if (heading) {
                heading.textContent = `Search Results for "${searchQuery}"`;
            }

            if (isGlobal) {
            // For global search, clear everything below the search bar
                document.querySelectorAll('[data-category-id]').forEach(categoryDiv => {
                    if (categoryDiv !== parentCategoryDiv) {
                        categoryDiv.style.display = 'none';
                    }
                });
                // Clear and render products in the container
                productContainer.innerHTML = ''; // Clear previous results
            } else {
                // Clear only product listings, leaving other elements like the search bar intact
                const productContainerSelector = parentCategoryDiv.querySelector('.product-container');
                if (productContainerSelector) {
                    productContainerSelector.innerHTML = ''; // Clear previous results
                }
                productContainer = productContainerSelector;
            }

            // Handle case where no products are found
            if (products.length === 0) {
                productContainer.innerHTML = '<p class="w-full h-48 text-gray-500 text-center">No products found.</p>';
                return;
            }

            // Render new products
            products.forEach(product => {
                const productHTML = `
                    <a href="/product/${product.id}" class="group flex flex-col items-center text-center product">
                        <div class="w-52 h-52 flex items-center justify-center overflow-hidden rounded-lg bg-gray-200">
                            <img src="/storage/${product.thumbnail.path}" 
                                 alt="${product.title}" 
                                 class="h-full w-full object-cover object-center group-hover:opacity-75">
                        </div>
                        <p class="mt-4 text-xl font-semibold text-primary w-full break-words line-clamp-2 h-16">
                            ${product.title}
                        </p>
                        <p class="mt-2 text-lg font-medium text-primary">${product.formatted_price}</p>
                    </a>
                `;
                productContainer.innerHTML += productHTML;
            });
        }
    };

    // Function to perform AJAX search
    const performSearch = async (query, categoryId = null) => {
        try {
            const response = await fetch(`/search-products-list?query=${query}&category_id=${categoryId || ''}`);
            const products = await response.json();

            if (categoryId) {
                // Handle category-specific search
                const parentCategoryDiv = document.querySelector('.product-container');
                console.log(parentCategoryDiv);
                renderProducts(products, parentCategoryDiv, query);
            } else {
                // Handle global search
                const parentContainer = document.querySelector('.product-container'); // Main container
                console.log(parentContainer);
                renderProducts(products, parentContainer, query, true);
            }
        } catch (error) {
            console.error('Error fetching products:', error);
        }
    };

    // Global search functionality
    if (globalSearchInput) {
        globalSearchInput.addEventListener('input', (event) => {
            const query = event.target.value.trim();

            if (query === '') {
                // Reset to show all products and sections
                window.location.reload();
            } else {
                performSearch(query); // Perform search globally
            }
        });
    }

    // Category-specific search functionality
    if (categorySearchInputs) {
        categorySearchInputs.forEach(input => {
            const categoryId = input.getAttribute('data-category-id');

            input.addEventListener('input', (event) => {
                const query = event.target.value.trim();

                if (query === '') {
                    // Reset to show all category products and sections
                    window.location.reload();
                } else {
                    performSearch(query, categoryId); // Perform search within the category
                }
            });
        });
    }
});
    </script>
</x-layout>
