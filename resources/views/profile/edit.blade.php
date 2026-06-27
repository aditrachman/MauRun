<x-app-layout>
    <div class="max-w-3xl mx-auto px-4 pt-4 pb-8 space-y-6">
        <div class="mb-1">
            <p class="text-xs font-semibold text-primary uppercase tracking-[1.5px]">Akun</p>
            <h2 class="font-display text-2xl md:text-3xl text-ink font-normal leading-tight mt-1">Profile</h2>
        </div>

        <div class="p-4 sm:p-8 bg-cream border border-beige-deep rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-cream border border-beige-deep rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-cream border border-beige-deep rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>