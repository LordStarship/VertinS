<x-layout>
    <div class="bg-white">
        <div class="pt-6 pb-6">
            <div class="mx-auto max-w-7xl px-4 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-10">
                    <div>
                        <div class="mb-4">
                            <img id="mainImage" src="{{ asset('storage/' . $defaultPicture->path) }}" alt="{{ $product->title }}" class="w-full h-72 rounded-lg object-cover cursor-pointer" onclick="openLightbox(this.src)">
                        </div>
                        <div class="flex justify-center space-x-4">
                            @foreach($pictures as $picture)
                                <img src="{{ asset('storage/' . $picture->path) }}" alt="Product Image" class="w-20 h-20 rounded-lg object-cover cursor-pointer" onclick="updateMainImage(this.src)">
                            @endforeach
                        </div>
                    </div>

                    <div id="lightbox" class="hidden fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50">
                        <span class="absolute top-5 right-5 text-white text-3xl cursor-pointer" onclick="closeLightbox()">&times;</span>
                        <img id="lightboxImage" src="" alt="Enlarged Image" class="max-w-full max-h-full transform scale-100 transition-transform duration-300">
                    </div>
                  
                    <div>
                        <p class="w-full text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl break-words">{{ $product->title }}</p>
                        <div class="mt-4">
                            <p class="mt-2 text-base text-gray-900">{{ $product->description }}</p>
                        </div>
                        <div class="bg-primary rounded-md mt-6 py-4 text-center">
                            <div class="text-3xl font-bold text-yellow-300">{{ formatRupiah($product->price) }}</div>
                        </div>
                        <div class="bg-primary rounded-md mt-6">
                            <h3 class="text-3xl font-bold text-yellow-300 pl-4 py-1">Contact</h3>
                            <ul role="list" class="space-y-2 pl-4 py-2 text-lg">
                                @foreach($medias as $media)
                                    <li class="text-yellow-300"> {{ $media->social_media }} : 
                                          <a href="{{ $media->url }}" class="text-yellow-300 underline font-semibold" target="_blank" onclick="incrementMessageCount({{ $product->id }})"> Click here to order!</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
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
<script>
    function updateMainImage(src) {
        document.getElementById('mainImage').src = src;
    }

    function openLightbox(src) {
        const lightbox = document.getElementById('lightbox');
        const lightboxImage = document.getElementById('lightboxImage');
        lightboxImage.src = src;
        lightbox.classList.remove('hidden');
    }

    function closeLightbox() {
        const lightbox = document.getElementById('lightbox');
        lightbox.classList.add('hidden');
    }

    document.getElementById('lightbox').addEventListener('click', (e) => {
        if (e.target === e.currentTarget) {
            closeLightbox();
        }
    });

    document.getElementById('lightboxImage').addEventListener('wheel', (e) => {
        e.preventDefault();
        const image = e.currentTarget;
        const scaleStep = 0.1;
        let currentScale = parseFloat(getComputedStyle(image).getPropertyValue('--scale')) || 1;

        if (e.deltaY < 0) {
            currentScale += scaleStep; // Zoom in
        } else {
            currentScale = Math.max(0.5, currentScale - scaleStep); // Zoom out, minimum scale 0.5
        }

        image.style.setProperty('--scale', currentScale);
        image.style.transform = `scale(${currentScale})`;
    });
</script>

<style>
    #lightboxImage {
        --scale: 1;
    }
</style>