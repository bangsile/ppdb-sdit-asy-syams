<x-layouts.app :title="__('Dashboard')">
    <flux:heading class="text-xl mb-4">Dashboard</flux:heading>
    <flux:separator variant="subtle" class="mb-4" />
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="relative rounded-xl border border-neutral-200 p-7">
            <h1 class="font-medium text-">Selamat Datang di Sistem PPDB SDIT Asy-Syams Tidore</h1>
            @if (!$siswa)
                <p class="mt-5 text-sm">Anda belum melakukan pendaftaran peserta didik baru. Silahkan daftar terlebih dahulu.
                </p>
                <flux:button href="{{ route('pendaftaran') }}" class="mt-2" variant="primary" color="emerald" size="sm">
                    Daftar di sini
                </flux:button>
            @else
                <p class="mt-5 text-sm">Anda telah melakukan pendaftaran peserta didik baru. Anda dapat melihat status pendaftaran atau
                    mendaftarkan peserta didik baru yang lain.
                </p>
                <flux:button href="{{ route('pendaftaran.status') }}" variant="primary" size="sm" class="mt-2 border me-1 border-emerald-600 bg-white text-emerald-600 hover:bg-gray-50" >
                    Status Pendaftaran
                </flux:button>
                <flux:button href="{{ route('pendaftaran') }}" class="mt-2" variant="primary" color="emerald" size="sm">
                    Daftar lagi
                </flux:button>
            @endif
        </div>
    </div>
</x-layouts.app>
