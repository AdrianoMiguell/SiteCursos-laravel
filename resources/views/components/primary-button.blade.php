<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btnGeral btnGeral-dark']) }}>
    {{ $slot }}
</button>
