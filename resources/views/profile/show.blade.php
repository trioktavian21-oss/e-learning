<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-slate-900 tracking-tight">
            {{ __('Pengaturan Profil & Keamanan') }}
        </h2>
    </x-slot>

    <div class="relative overflow-hidden">
        <!-- Background Decoration -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-brand-500/5 rounded-full blur-[100px] -mr-48 -mt-48"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-indigo-500/5 rounded-full blur-[100px] -ml-32 -mb-32"></div>

        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="space-y-12">
                @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                    <div class="bg-white/60 backdrop-blur-sm rounded-[3rem] p-4 sm:p-8 border border-white shadow-xl shadow-slate-200/50 transition hover:shadow-2xl duration-500">
                        @livewire('profile.update-profile-information-form')
                    </div>

                    <div class="hidden sm:block">
                        <div class="py-4">
                            <div class="border-t border-slate-100"></div>
                        </div>
                    </div>
                @endif

                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                    <div class="bg-white/60 backdrop-blur-sm rounded-[3rem] p-4 sm:p-8 border border-white shadow-xl shadow-slate-200/50 transition hover:shadow-2xl duration-500">
                        @livewire('profile.update-password-form')
                    </div>

                    <div class="hidden sm:block">
                        <div class="py-4">
                            <div class="border-t border-slate-100"></div>
                        </div>
                    </div>
                @endif

                @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                    <div class="bg-white/60 backdrop-blur-sm rounded-[3rem] p-4 sm:p-8 border border-white shadow-xl shadow-slate-200/50 transition hover:shadow-2xl duration-500">
                        @livewire('profile.two-factor-authentication-form')
                    </div>

                    <div class="hidden sm:block">
                        <div class="py-4">
                            <div class="border-t border-slate-100"></div>
                        </div>
                    </div>
                @endif

                <div class="bg-white/60 backdrop-blur-sm rounded-[3rem] p-4 sm:p-8 border border-white shadow-xl shadow-slate-200/50 transition hover:shadow-2xl duration-500">
                    @livewire('profile.logout-other-browser-sessions-form')
                </div>

                @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                    <div class="hidden sm:block">
                        <div class="py-4">
                            <div class="border-t border-slate-100"></div>
                        </div>
                    </div>

                    <div class="bg-rose-50/50 backdrop-blur-sm rounded-[3rem] p-4 sm:p-8 border border-rose-100 shadow-xl shadow-rose-200/20 transition hover:shadow-2xl duration-500">
                        @livewire('profile.delete-user-form')
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
