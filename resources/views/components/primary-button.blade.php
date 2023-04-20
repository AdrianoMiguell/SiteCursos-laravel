<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btnGeral']) }}>
    {{ $slot }}
</button>
