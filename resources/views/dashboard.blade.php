<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="relative rounded-xl border border-neutral-200 p-7">
            <h1 class="font-medium text-lg">Selamat Datang di Sistem PPDB SDIT Asy-Syams Tidore</h1>
            @if (!$siswa)
                <p class="mt-10">Anda belum melakukan pendaftaran peserta didik baru. Silahkan daftar terlebih dahulu.
                </p>
                <flux:button href="{{ route('pendaftaran') }}" class="mt-2" variant="primary" color="emerald">
                    Daftar di sini
                </flux:button>
            @endif
        </div>
    </div>
</x-layouts.app>
