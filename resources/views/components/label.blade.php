@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-black text-[10px] uppercase tracking-widest text-slate-400 mb-2']) }}>
    {{ $value ?? $slot }}
</label>
