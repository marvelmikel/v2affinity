
<x-mail::layout>
{{-- Header --}}
<x-slot:header>
{{ config('app.name') }}
<tr>
    <td class="header">
        <a href="{{ route('home') }}" style="display: inline-block;">
            @if (!$store || !$store->store_logo)
                <img src="{{ route('home') }}/images/affinity-email-logo.png" class="logo" alt="{{ config('app.name') }} Logo" style="width: auto; height: 38px;">
            @else
                <img src="{{ route('home') }}/{{ $store->store_logo }}" class="logo" alt="{{ config('app.name') }} Logo" style="width: auto; height: 38px;">
            @endif
        </a>
    </td>
</tr>

</x-slot:header>


{{-- Body --}}
# Your Invoice

Dear {{ $customer->name }},<br>

Please see attached a copy of your invoice.<br>

Kind regards,<br>

Thanks,<br>
{{ config('app.name') }}

{{-- Subcopy --}}
@isset($subcopy)
<x-slot:subcopy>
<x-mail::subcopy>
{{ $subcopy }}
</x-mail::subcopy>
</x-slot:subcopy>
@endisset

{{-- Footer --}}
<x-slot:footer>
<x-mail::footer>
© {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
</x-mail::footer>
</x-slot:footer>
</x-mail::layout>
