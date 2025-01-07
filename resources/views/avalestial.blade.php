<x-layout>
    <div class="h-full w-full bg-white">
        <div class="flex flex-row">
            <a href="{{ route('list', ['category_id' => 8]) }}" class="relative group overflow-hidden">
                <img src="{{ asset('storage/img/img-mlbb.png') }}" class="w-full dynamic-height object-cover">
                <div class="absolute inset-0 bg-black bg-opacity-75 group-hover:bg-opacity-50 transition duration-300"></div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <p class="text-secondary text-opacity-50 text-3xl font-medium group-hover:text-opacity-100 group-hover:text-4xl transition duration-300 ease-in-out">
                        Mobile Legends Bang Bang
                    </p>
                </div> 
            </a>
            <a href="{{ route('list', ['category_id' => 3]) }}" class="relative group overflow-hidden">
                <img src="{{ asset('storage/img/img-genshin.png') }}" class="w-full dynamic-height object-cover">
                <div class="absolute inset-0 bg-black bg-opacity-75 group-hover:bg-opacity-50 transition duration-300"></div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <p class="text-secondary text-opacity-50 text-3xl font-medium group-hover:text-opacity-100 group-hover:text-4xl transition duration-300 ease-in-out">
                        Genshin Impact
                    </p>
                </div>
            </a>
            <a href="{{ route('list', ['category_id' => 7]) }}" class="relative group overflow-hidden">
                <img src="{{ asset('storage/img/img-starrail.png') }}" class="w-full dynamic-height object-cover">
                <div class="absolute inset-0 bg-black bg-opacity-75 group-hover:bg-opacity-50 transition duration-300"></div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <p class="text-secondary text-opacity-50 text-3xl font-medium group-hover:text-opacity-100 group-hover:text-4xl transition duration-300 ease-in-out">
                        Honkai Star Rail
                    </p>
                </div>
            </a>
        </div>    
    </div>
</x-layout>
