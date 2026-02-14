<div class="md:col-span-1 flex justify-between">
    <div class="px-4 sm:px-0">
        <h3 class="text-xl font-black text-slate-900 tracking-tight">{{ $title }}</h3>

        <p class="mt-2 text-xs font-medium text-slate-500 italic leading-relaxed">
            {{ $description }}
        </p>
    </div>

    <div class="px-4 sm:px-0">
        {{ $aside ?? '' }}
    </div>
</div>
