<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="bg-white">
      <div class="mx-auto grid max-w-2xl grid-cols-1 items-center gap-x-8 gap-y-16 px-4 py-24 sm:px-6 sm:py-32 lg:max-w-7xl lg:grid-cols-2 lg:px-8">
        <div>
          <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Avalon Celestial Store</h2>
          <p class="mt-4 text-gray-500">Avalon Celestial Store adalah sebuah toko daring yang menyediakan layanan penjualan akun untuk berbagai game populer. Toko ini menghadirkan beragam pilihan akun premium dan eksklusif untuk para gamer, termasuk untuk game seperti Honkai: Star Rail,Wuthering Waves, Reverse: 1999, dan Genshin Impact.<br>
          Dengan fokus pada kualitas dan kepuasan pelanggan, Avalon Celestial atau yang disebut Ava'Lestial menjadi tempat yang terpercaya bagi para pemain yang mencari akun dengan progres tertentu, karakter, atau item langka untuk meningkatkan pengalaman bermain mereka.</p>
    
          <dl class="mt-16 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 sm:gap-y-16 lg:gap-x-8">
            <div class="border-t border-gray-200 pt-4">
              <dt class="font-medium text-gray-900">Trusted</dt>
              <dd class="mt-2 text-sm text-gray-500">Reliable and dependable, ensuring customers feel secure in their transactions.</dd>
            </div>
            <div class="border-t border-gray-200 pt-4">
              <dt class="font-medium text-gray-900">Friendly</dt>
              <dd class="mt-2 text-sm text-gray-500">Approachable and welcoming, providing a positive and supportive experience for all customers.</dd>
            </div>
            <div class="border-t border-gray-200 pt-4">
              <dt class="font-medium text-gray-900">Fast Service</dt>
              <dd class="mt-2 text-sm text-gray-500">Efficient and quick, ensuring that customers' needs are met promptly without unnecessary delays.</dd>
            </div>
            <div class="border-t border-gray-200 pt-4">
              <dt class="font-medium text-gray-900">Comfort</dt>
              <dd class="mt-2 text-sm text-gray-500">Creating a relaxed and stress-free environment, prioritizing the convenience and satisfaction of customers.</dd>
            </div>
            <div class="border-t border-gray-200 pt-4">
              <dt class="font-medium text-gray-900">Accountable</dt>
              <dd class="mt-2 text-sm text-gray-500">Accountable for actions, ensuring honesty, transparency, and commitment to providing high-quality service.</dd>
            </div>
            <div class="border-t border-gray-200 pt-4">
              <dt class="font-medium text-gray-900">Fair</dt>
              <dd class="mt-2 text-sm text-gray-500">Accountable for actions, ensuring honesty, transparency, and commitment to providing high-quality service.</dd>
            </div>
          </dl>
        </div>
        <div class="grid grid-cols-2 grid-rows-2 gap-2 sm:gap-4 lg:gap-6">
          <img src= {{ asset('img/R1999.jpg') }} alt="Walnut card tray with white powder coated steel divider and 3 punchout holes." class="w-[280px] h-[280px] rounded-lg bg-gray-100">
          <img src= {{ asset('img/GI1.jpg') }} alt="Top down view of walnut card tray with embedded magnets and card groove." class="w-[280px] h-[280px] rounded-lg bg-gray-100">
          <img src= {{ asset('img/HSR1.jpg') }} alt="Side of walnut card tray with card groove and recessed card area." class="w-[280px] h-[280px] rounded-lg bg-gray-100">
          <img src= {{ asset('img/Wuwa1.jpg') }} alt="Walnut card tray filled with cards and card angled in dedicated groove." class="w-[280px] h-[280px] rounded-lg bg-gray-100 object-left">
        </div>
        
    
  </x-layout>