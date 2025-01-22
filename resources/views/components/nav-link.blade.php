@props(['active' => false])

<a 
    {{ $attributes->merge(['class' => 
        'rounded-md px-3 py-2 text-sm font-medium ' . 
        ($active 
            ? 'bg-primary-passive text-secondary font-bold' 
            : 'text-secondary hover:bg-primary-passive hover:text-secondary')
    ]) }} 
    aria-current="{{ $active ? 'page' : false }}"
>
    {{ $slot }}
</a>
