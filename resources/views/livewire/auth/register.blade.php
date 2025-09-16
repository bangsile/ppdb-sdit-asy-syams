<div class="flex flex-col gap-6">
    <x-auth-header title="Registrasi Akun" description="Masukkan informasi anda untuk membuat akun" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form method="POST" wire:submit="register" class="flex flex-col gap-6">
        <!-- Name -->
        <flux:input wire:model="name" label="Nama" type="text" required autofocus autocomplete="name"
            placeholder="Nama" />

        <!-- Email Address -->
        <flux:input wire:model="email" label="Email" type="email" required autocomplete="email"
            placeholder="email@example.com" />

        <!-- Password -->
        <flux:input wire:model="password" label="Password" type="password" required placeholder="Password" viewable />

        <!-- Confirm Password -->
        <flux:input wire:model="password_confirmation" label="Konfirmasi password" type="password" required
            placeholder="Konfirmasi password" viewable />

        <div class="flex flex-col items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full">
                Daftar
            </flux:button>
            <flux:separator text="atau" class="my-5" />
            <flux:button class="w-full" type="button">
                <flux:brand href="{{ route('google.login') }}" name="Daftar dengan Google">
                    <x-slot name="logo" class="size-6 rounded-full ">
                        <flux:icon name="google" />
                    </x-slot>
                </flux:brand>
            </flux:button>
        </div>
    </form>

    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
        <span>Sudah punya akun?</span>
        <flux:link :href="route('login')" wire:navigate>Masuk</flux:link>
    </div>
</div>
