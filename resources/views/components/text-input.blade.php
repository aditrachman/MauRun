@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full rounded-md border-hairline-strong bg-canvas text-sm text-ink px-3 py-2.5 focus:border-primary focus:ring-primary']) }}>
