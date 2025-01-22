<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    @foreach ($testing as $post)
        
    
    <article class ="py-8 max-w-screen-md border-b border-gray-300" >
        <a href="/testing/{{ $post['id'] }}" class = "hover:underline">
        <h2 class="mb-1 text-3xl tracking-tight font-bold text-gray-900">
            {{ $post['title'] }}</a>
        </h2>
        <div class = " text-base text-gray-500">
            <a href="#">{{ $post['author'] }}</a> | 26 November 2025
        </div>
        <p class ="my-4 font-light">{{Str::limit($post['body'])}}</p>
        <a href="/testing/{{ $post['id'] }}" class = "font-medium text-blue-500">Read more &raquo; </a>
    </article>

    @endforeach
</x-layout>