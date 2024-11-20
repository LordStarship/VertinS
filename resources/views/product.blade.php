<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    
    <div class="bg-white">
      <div class="pt-6">
        <nav aria-label="Breadcrumb">
    
        <!-- Image gallery -->
        {{-- <div class="mx-auto mt-6 max-w-2xl sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-3 lg:gap-x-8 lg:px-8">
          <div class="aspect-h-5 aspect-w-4 hidden overflow-hidden rounded-lg lg:block">
            <img src="img/Char1.jpg" alt="Two each of gray, white, and black shirts laying flat." class="h-full w-full object-cover object-left">
          </div>
          <div class="hidden lg:grid lg:grid-cols-1 lg:gap-y-8">
            <div class="aspect-h-2 aspect-w-3 overflow-hidden rounded-lg">
              <img src="img/Weapon1.jpg" alt="Model wearing plain black basic tee." class="h-full w-full object-cover object-left">
            </div>
            <div class="aspect-h-2 aspect-w-3 overflow-hidden rounded-lg">
              <img src="img/Banner1.jpg" alt="Model wearing plain gray basic tee." class="h-full w-full object-cover object-left scale-20">
            </div>
          </div>
          <div class="aspect-h-5 aspect-w-4 lg:aspect-h-4 lg:aspect-w-3 sm:overflow-hidden sm:rounded-lg">
            <img src="img/UL1.jpg" alt="Model wearing plain white basic tee." class="h-full w-full object-cover object-left">
          </div>
        </div> --}}
        <div class="mx-auto mt-6 max-w-2xl sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-3 lg:gap-x-8 lg:px-8">
          <img src="img/Char1.jpg" alt="Two each of gray, white, and black shirts laying flat." class="hidden aspect-[3/4] size-full rounded-lg object-cover lg:block object-left">
          <div class="hidden lg:grid lg:grid-cols-1 lg:gap-y-8">
            <img src="img/Weapon1.jpg" alt="Model wearing plain black basic tee." class="aspect-[3/2] size-full rounded-lg object-cover object-left">
            <img src="img/Banner1.jpg" alt="Model wearing plain gray basic tee." class="aspect-[3/2] size-full rounded-lg object-cover object-left">
          </div>
          <img src="img/UL1.jpg" alt="Model wearing plain white basic tee." class="aspect-[4/5] size-full object-cover sm:rounded-lg lg:aspect-[3/4]">
        </div>
    
        <!-- Product info -->
        <div class="mx-auto max-w-2xl px-4 pb-16 pt-10 sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-3 lg:grid-rows-[auto,auto,1fr] lg:gap-x-8 lg:px-8 lg:pb-24 lg:pt-16">
          <div class="lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
            <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">Shorekeeper Starter Account</h1>
          </div>
    
          <!-- Options -->
          <div class="mt-4 lg:row-span-3 lg:mt-0">
            <div class="mt-10 flex w-full items-center justify-center rounded-md border border-transparent bg-black px-6 py-5 text-2xl font-semibold text-yellow-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                $5
            </div>

            <form class="mt-10">
                <div class="bg-black rounded-md min-h-[170px]">
                    <h3 class="sr-only">Description</h3>
                    
                    <div class="space-y-5">
                        <h1 class="text-3xl font-bold text-yellow-300 pl-4 py-1"> Contact</h1>
                        <ul role="list" class="space-y-3 pl-4 text-sm">
                            <li class="text-yellow-300"><span class="text-yellow-300">Whatsapp : </span></li>
                            <li class="text-yellow-300"><span class="text-yellow-300">Facebook : </span></li>
                            <li class="text-yellow-300"><span class="text-yellow-300">Instagram : </span></li>
                            <li class="text-yellow-300"><span class="text-yellow-300">LINE : </span></li>
                        </ul>
                    </div>
                </div>
                
              <!-- Colors -->
              <!-- Sizes -->

              {{-- <button type="submit" class="mt-10 flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-8 py-3 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Add to bag</button> --}}
            </form>
          </div>
    
          <div class="py-10 lg:col-span-2 lg:col-start-1 lg:border-r lg:border-gray-200 lg:pb-16 lg:pr-8 lg:pt-6">
            <!-- Description and details -->
            <div>
              <h3 class="sr-only">Description</h3>
    
              <div class="space-y-6">
                <p class="text-base text-gray-900">Wuthering Waves Starter Account is your gateway to an epic adventure! Unlock premium characters, exclusive gear, and bonus resources to accelerate your progress and dominate the action-packed world. Don’t miss the chance to start strong!</p>
              </div>
            </div>
    
            <div class="mt-10">
              <h3 class="text-sm font-medium text-gray-900">About Account</h3>
    
              <div class="mt-4">
                <ul role="list" class="list-disc space-y-2 pl-4 text-sm">
                  <li class="text-gray-400"><span class="text-gray-600">Login via Google</span></li>
                  <li class="text-gray-400"><span class="text-gray-600">No issue for the account</span></li>
                  <li class="text-gray-400"><span class="text-gray-600">Birthday Unset</span></li>
                  <li class="text-gray-400"><span class="text-gray-600">100% Safe Account</span></li>
                  <li class="text-gray-400"><span class="text-gray-600">Pick is only reference</span></li>
                </ul>
              </div>
            </div>
    
            <div class="mt-10">
              <h2 class="text-sm font-medium text-gray-900">Available</h2>
    
              <div class="mt-4 space-y-6">
                <p class="text-sm text-gray-600">Shorekeeper Starter account with Verina and other good </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </x-layout>
  
  