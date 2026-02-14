<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-6 py-3 bg-brand-600 border border-transparent rounded-2xl font-black text-[10px] text-white uppercase tracking-[0.2em] shadow-lg shadow-brand-600/30 hover:bg-brand-700 focus:bg-brand-700 active:bg-brand-800 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
