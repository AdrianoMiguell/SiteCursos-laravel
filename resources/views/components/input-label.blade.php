@props(['value'])

<label {{ $attributes->merge(['class' => 'd-block fs-5']) }}>
    {{ $value ?? $slot }}
</label>
