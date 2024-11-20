@props(['active' => false])
<a {{ $attributes }}
class=" {{ $active ? 'bg-gray-900 text-yellow-300' : 'text-yellow-400 hover:bg-gray-700 hover:text-yellow-300'}} rounded-md px-3 py-2 text-sm font-medium "aria-current="{{ $active ? 'page' : false }}" >{{ $slot }}</a>