<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <article class ="py-8 max-w-screen-md border-b border-gray-300" >
    
        <h2 class="mb-1 text-3xl tracking-tight font-bold text-gray-900">
            {{ $testings['title'] }}
        </h2>
        <div class = " text-base text-gray-500">
            <a href="#">{{ $testings['author'] }}</a> | 26 November 2025
        </div>
        <p class ="my-4 font-light">{{($testings['body'])}}</p>
        <a href="/testing" class = "font-medium text-blue-500">&laquo lets go Back </a>
    </article>


</x-layout>