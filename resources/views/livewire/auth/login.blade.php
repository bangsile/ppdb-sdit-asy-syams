<div class="flex flex-col gap-6">
    <x-auth-header title="Masuk" description="Masukkan email dan password anda untuk masuk" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form method="POST" wire:submit="login" class="flex flex-col gap-6">
        <!-- Email Address -->
        <flux:input wire:model="email" label="Email" type="email" required autofocus autocomplete="email"
            placeholder="email@example.com" />

        <!-- Password -->
        <div class="relative">
            <flux:input wire:model="password" label="Password" type="password" required placeholder="Password"
                viewable />

            @if (Route::has('password.request'))
                <flux:link class="absolute end-0 top-0 text-sm" :href="route('password.request')" wire:navigate>
                    Lupa password?
                </flux:link>
            @endif
        </div>

        <!-- Remember Me -->
        {{-- <flux:checkbox wire:model="remember" :label="__('Remember me')" /> --}}

        <div class="flex flex-col items-center justify-end">
            <flux:button variant="primary" type="submit" class="w-full">Masuk</flux:button>
            <flux:separator text="atau" class="my-5" />
            <flux:button class="w-full">
                <flux:brand href="{{ route('google.login') }}" name="Masuk dengan Google">
                    <x-slot name="logo" class="size-6 rounded-full ">
                        <flux:icon name="google" />
                    </x-slot>
                </flux:brand>
            </flux:button>
        </div>
    </form>

    @if (Route::has('register'))
        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
            <span>Belum punya akun?</span>
            <flux:link :href="route('register')" wire:navigate>Daftar</flux:link>
        </div>
    @endif
</div>
