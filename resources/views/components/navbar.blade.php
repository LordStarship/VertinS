<nav class="bg-primary" x-data="{ isOpen: false }">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 items-center justify-between">
        <div class="flex items-center">
          <a href={{route('home')}}>
            <div class="flex-shrink-0">
              <img class="h-16 w-16" src={{ asset('storage/img/logo-user-2.png') }} alt="Your Company">
            </div>
          </a>
          <div class="hidden md:block">
            <div class="ml-10 flex items-center justify-center space-x-4">
              <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
              {{-- <x-nav-link href="/avalestial" :active="request()->is('avalestial')">Ava'Lestial</x-nav-link> --}}
              <x-nav-link href="{{ route('list') }}">Products List</x-nav-link>
              {{-- <x-nav-link href="/about" :active="request()->is('about')">About</x-nav-link> --}}
              {{-- <x-nav-link href="/testing" :active="request()->is('testing')">Testing</x-nav-link> --}}
              
            </div>
          </div>
        </div>
        <div class="hidden md:block">
          <div class="ml-4 flex items-center md:ml-6">

            <!-- Profile dropdown -->
            <div class="relative ml-3">
              <div>
                <a type="button" href="{{ route('login')}}"
                    class="relative flex max-w-xs items-center justify-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 h-10 w-10" 
                    id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                  <span class="sr-only">Open user menu</span>
                  <div class="flex items-center justify-center h-full w-full">
                    <i class="fa-solid fa-user text-secondary text-2xl"></i>
                  </div>
                </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>