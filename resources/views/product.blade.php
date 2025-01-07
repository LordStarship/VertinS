<x-layout>
  <div class="bg-white">
      <div class="pt-6 pb-6">
          <div class="mx-auto max-w-7xl px-4 lg:px-8">
              <!-- Main Image and Slideshow -->
              <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-10">
                  <!-- Main Image -->
                  <div>
                      <div class="mb-4">
                          <img id="mainImage" 
                               src="{{ asset('storage/' . $defaultPicture->path) }}" 
                               alt="{{ $product->title }}" 
                               class="w-full h-72 rounded-lg object-cover">
                      </div>

                      <!-- Slideshow -->
                      <div class="flex justify-center space-x-4">
                          @foreach($pictures as $picture)
                              <img src="{{ asset('storage/' . $picture->path) }}" 
                                   alt="Product Image" 
                                   class="w-20 h-20 rounded-lg object-cover cursor-pointer"
                                   onclick="updateMainImage(this.src)">
                          @endforeach
                      </div>
                  </div>

                  <!-- Product Info -->
                  <div>
                      <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">{{ $product->title }}</h1>

                      <!-- Description -->
                      <div class="mt-4">
                          <h3 class="text-lg font-semibold text-gray-900">Description</h3>
                          <p class="mt-2 text-base text-gray-900">{{ $product->description }}</p>
                      </div>

                      <!-- Price Section -->
                      <div class="bg-primary rounded-md mt-6 py-4 text-center">
                          <div class="text-3xl font-bold text-yellow-300">
                              {{ number_format($product->price, 0, ',', '.') }}
                          </div>
                      </div>

                      <!-- Contact Section -->
                      <div class="bg-primary rounded-md mt-6">
                          <h3 class="text-3xl font-bold text-yellow-300 pl-4 py-1">Contact</h3>
                          <ul role="list" class="space-y-2 pl-4 py-2 text-lg">
                              @foreach($medias as $media)
                                  <li class="text-yellow-300">
                                      {{ $media->social_media }} : 
                                      <a href="{{ $media->url }}" 
                                         class="text-yellow-300 underline font-semibold"
                                         target="_blank"
                                         onclick="incrementMessageCount({{ $product->id }})">
                                         Click here to order!
                                      </a>
                                  </li>
                              @endforeach
                          </ul>
                      </div>

                      <!-- View and Message Count -->
                      <div class="mt-4 text-sm text-gray-500">
                          <p>Views: {{ $product->count_view }}</p>
                          <p>Messages Sent: {{ $product->message_count }}</p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <script>
      function updateMainImage(src) {
          const mainImage = document.getElementById('mainImage');
          mainImage.src = src;
      }

      async function incrementMessageCount(productId) {
          try {
              await fetch(`/product/${productId}/increment-message-count`, {
                  method: 'POST',
                  headers: {
                      'Content-Type': 'application/json',
                      'X-CSRF-TOKEN': '{{ csrf_token() }}'
                  }
              });
          } catch (error) {
              console.error('Failed to increment message count:', error);
          }
      }
  </script>
</x-layout>
