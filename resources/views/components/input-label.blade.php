@props(['value','required' => false])
<label {{ $attributes->merge(['class' => 'block font-medium livvic-font-medium text-slate-500']) }}>
    {{ $value ?? $slot }}
    @if($required)
        <span class="ml-1 text-red-500">*</span>
    @endif
</label>
