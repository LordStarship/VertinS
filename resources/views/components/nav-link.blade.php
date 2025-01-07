@props(['active' => false])
<a {{ $attributes }}
class=" {{ $active ? 'bg-primary text-secondary' : 'text-secondary hover:bg-primary-passive hover:text-secondary'}} rounded-md px-3 py-2 text-sm font-medium "aria-current="{{ $active ? 'page' : false }}" >{{ $slot }}</a>