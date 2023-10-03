@props(['value', 'required' => false])
<label {{ $attributes->merge(['class' => 'block font-medium mb-1 text-gray-700 text-slate--600']) }}>
    {{ $value ?? $slot }}
    @if($required)
        <span class="text-red-500 ml-1">*</span>
    @endif
</label>
