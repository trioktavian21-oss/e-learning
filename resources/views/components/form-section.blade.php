@props(['submit'])

<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-3 md:gap-6']) }}>
    <x-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-section-title>

    <div class="mt-5 md:mt-0 md:col-span-2">
        <form wire:submit="{{ $submit }}">
            <div class="px-6 py-8 bg-white/80 border border-slate-100 {{ isset($actions) ? 'rounded-t-[2.5rem]' : 'rounded-[2.5rem]' }} shadow-sm">
                <div class="grid grid-cols-6 gap-6">
                    {{ $form }}
                </div>
            </div>

            @if (isset($actions))
                <div class="flex items-center justify-end px-6 py-4 bg-slate-50/50 border border-slate-100 border-t-0 text-end rounded-b-[2.5rem] shadow-sm">
                    {{ $actions }}
                </div>
            @endif
        </form>
    </div>
</div>
