<button {{ $attributes->merge(['type' => 'submit', 'class' => 'green-btn w-full']) }}>
    {{ $slot }}
</button>
