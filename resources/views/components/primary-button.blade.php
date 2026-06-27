<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-ink border border-transparent rounded-md font-medium text-xs text-on-dark uppercase tracking-widest hover:bg-charcoal focus:bg-charcoal active:bg-ink focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
