<x-layout>
  <x-slot:title>{{ $title }}</x-slot:title>
  <div class="bg-white">
      <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 sm:py-4 lg:px-8">
          <h2 class="text-2xl font-bold tracking-tight text-gray-900 mb-6">Wuthering Waves</h2>
          <!-- Container with grid for horizontal and vertical layout -->
          <div class="grid grid-cols-2 gap-x-6 gap-y-10 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
              @foreach($products as $product)
                  <a href="/product/{{ $product['id'] }}" class="group">
                      <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-lg bg-gray-200">
                          <img src="{{ asset($product->thumbnail->path) }}" 
                               alt="Tall slender porcelain bottle with natural clay textured body and cork stopper."
                               class="h-full w-full object-cover object-center group-hover:opacity-75">
                      </div>
                      <h3 class="mt-4 text-sm text-gray-700">{{ $product->title }}</h3>
                      <p class="mt-1 text-lg font-medium text-gray-900">{{ number_format($product->price, 0, ',', '.') }}</p>
                  </a>
              @endforeach
          </div>
      </div>
  </div>
</x-layout>
