<x-mail::message>
{{-- Body --}}
# Your Invoice

Dear {{ $customer->name }},<br>

Please see attached a copy of your invoice.<br>

Kind regards,<br>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
