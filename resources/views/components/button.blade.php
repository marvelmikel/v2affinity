@props([ 'format' => 'primary' ])
@php
    switch($format){
        case 'wire':
            $class = 'border-2 border-main-color text-main-color rounded font-semibold hover:bg-main-color hover:text-white duration-300 transition ease-in-out px-5 py-1.5';
            break;
        case 'warn':
            $class = 'border-2 border-red-500 text-red-500 rounded font-semibold hover:bg-red-500 hover:text-white duration-300 transition ease-in-out px-5 py-1.5';
            break;
        case 'primary':
        default:
            $class = 'border-2 border-main-color bg-main-color text-white rounded font-semibold transition ease-in-out hover:bg-custom2-purple-color hover:border-custom2-purple-color duration-300 px-5 py-1.5 livvic-font-semibold';
            break;
    }
@endphp
<button {{ $attributes->merge(['type' => 'submit', 'class' => $class]) }}>
    {{ $slot }}
</button>
