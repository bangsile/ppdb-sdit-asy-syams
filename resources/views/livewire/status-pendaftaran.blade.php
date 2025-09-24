<div>
    <flux:heading class="text-xl mb-4">Status Pendaftaran </flux:heading>
    <flux:separator variant="subtle" class="mb-4" />
    {{-- @dd($siswa[0]->berkas) --}}
    <div class="flex h-full w-full flex-1 flex-col sm:flex-row flex-wrap gap-4 rounded-xl">
        @forelse ($siswa as $item)
            <div class="relative sm:w-md rounded-lg border border-neutral-200 p-3 flex itemce gap-5">
                <div class='w-28 sm:w-24 h-36 bg-cover bg-center rounded'
                    style="background-image: url({{ route('berkas.show', [$item->no_pendaftaran, basename($item->berkas->pas_foto)]) }})">
                </div>
                <div class="text-sm">
                    <p class="font-medium">{{ $item->no_pendaftaran }}</p>
                    <flux:callout.text>
                        <b>Status</b> :
                        @if ($item->status == 'calon')
                            @if (!$item->berkas->bukti_bayar)
                                <span class="font-medium text-red-600">Belum melakukan pembayaran</span>
                            @else
                                <span class="font-medium text-orange-600">Menunggu konfirmasi admin</span>
                            @endif
                        @elseif ($item->status == 'diterima')
                            <span class="font-medium text-emerald-600">Diterima</span>
                        @endif
                    </flux:callout.text>
                    <p class="mt-2">{{ $item->nama }}</p>
                    <p class="">{{ $item->jenis_kelamin }}</p>
                    <p class="mb-2">{{ $item->tempat_lahir . ', ' . format_tanggal($item->tanggal_lahir) }}</p>
                    <flux:button href="{{ route('pendaftaran.detail', $item->no_pendaftaran) }}"
                    size="xs" variant="primary" color="emerald">
                    Lihat Detail
                </flux:button>
                </div>
            </div>
        @empty
            <p>Anda belum melakukan pendaftaran</p>
        @endforelse
    </div>
</div>
