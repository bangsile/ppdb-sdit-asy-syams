<div>
    <flux:heading class="text-xl">Detail Pendaftaran </flux:heading>
    <flux:text class="mt-2 mb-6 text-base">{{ $siswa->nama }}</flux:text>
    <flux:separator variant="subtle" class="mb-4" />
    <flux:callout>
        <flux:callout.heading>Pendaftaran Berhasil</flux:callout.heading>
        <flux:callout.text>
            Silahkan lakukan pembayaran dan upload bukti pembayaran untuk menyelesaikan proses pendaftaran.
        </flux:callout.text>

        <x-slot name="actions" class="flex flex-wrap">
            <flux:button>Detail Pembayaran</flux:button>
            <flux:button variant="primary" href="#" class="">Upload Bukti Bayar</flux:button>
        </x-slot>
    </flux:callout>
    <x-notification class="fixed z-50 right-5 bottom-5" />

    <div class="border mt-5 p-5 rounded-xl text-sm grid grid-cols-1 md:grid-cols-2 gap-10">
        <div class="order-2 md:order-1 grid grid-cols-2 content-start">
            <p class="font-medium pb-2">No. Pendaftaran</p>
            <p>{{ $siswa->no_pendaftaran }}</p>
            <p class="font-medium pb-2">Nama</p>
            <p>{{ $siswa->nama }}</p>
            <p class="font-medium pb-2">NISN</p>
            <p>{{ $siswa->nisn }}</p>
            <p class="font-medium pb-2">NIK</p>
            <p>{{ $siswa->nik }}</p>
            <p class="font-medium pb-2">No. KK</p>
            <p>{{ $siswa->noKK }}</p>
            <p class="font-medium pb-2">Jenis Kelamin</p>
            <p>{{ $siswa->jenis_kelamin }}</p>
            <p class="font-medium pb-2">No. Akta Lahir</p>
            <p>{{ $siswa->no_reg_akta }}</p>
            <p class="font-medium pb-2">Anak ke</p>
            <p>{{ $siswa->anak_ke }}</p>
            <p class="font-medium pb-2">Tempat, Tanggal Lahir</p>
            <p>{{ $siswa->tempat_lahir . ', ' . format_tanggal($siswa->tanggal_lahir) }}</p>

            <p class="font-medium pb-2">Tinggi Badan</p>
            <p>{{ $siswa->tinggi_badan }} cm</p>
            <p class="font-medium pb-2">Berat Badan</p>
            <p>{{ $siswa->berat_badan }} kg</p>
            <p class="font-medium pb-2">Lingkar Kepala</p>
            <p>{{ $siswa->lingkar_kepala }} cm</p>

            <p class="font-medium pb-2">Alamat</p>
            <p>
                {{ $siswa->jalan ? 'Jl. ' . $siswa->jalan . ', ' : '' }}
                {{ 'RT ' . $siswa->rt . '/RW ' . $siswa->rw . '  Kel. ' . $siswa->kelurahan }}
            </p>
            <p class="font-medium pb-2">Jarak rumah ke sekolah</p>
            <p>{{ $siswa->jarak_rumah }} km</p>

            <flux:separator class="my-3" />
            <flux:separator class="my-3" />

            @foreach ($siswa->orangtua as $orangtua)
                <p class="font-semibold pb-2 pt-2 textba">Data {{ $orangtua->hubungan }}</p>
                <p></p>
                <p class="font-medium pb-2">Nama</p>
                <p>{{ $orangtua->nama }}</p>
                <p class="font-medium pb-2">NIK</p>
                <p>{{ $orangtua->nik }}</p>
                <p class="font-medium pb-2">Tempat, Tanggal Lahir</p>
                <p>{{ $orangtua->tempat_lahir . ', ' . format_tanggal($orangtua->tanggal_lahir) }}</p>
                <p class="font-medium pb-2">Pendidikan</p>
                <p>{{ $orangtua->pendidikan }}</p>
                <p class="font-medium pb-2">Pekerjaan</p>
                <p>{{ $orangtua->pekerjaan }}</p>
                <p class="font-medium pb-2">Penghasilan</p>
                <p>{{ format_rupiah($orangtua->penghasilan) }}</p>
                <p class="font-medium pb-2">No. HP</p>
                <p>{{ $orangtua->no_hp ?: '-' }}</p>
            @endforeach
        </div>
        <div class="order-1 md:order-2 place-items-center md:place-items-start">
            <img src="{{ route('berkas.show', [$siswa->no_pendaftaran, basename($siswa->berkas->pas_foto)]) }}"
                alt="pas-foto" class="w-36 rounded">
            <div>
                <flux:modal.trigger name="gantifoto">
                    <flux:button icon="pencil-square" class="mt-2">Ganti Foto</flux:button>
                </flux:modal.trigger>
            </div>
        </div>
    </div>

    <div class="flex items-center mt-2 gap-2">
        <flux:button icon="pencil-square" wire:navigate href="{{ route('pendaftaran.edit', $siswa->no_pendaftaran) }}">
            Edit Data
        </flux:button>
        <flux:modal.trigger name="berkas">
            <flux:button>Berkas</flux:button>
        </flux:modal.trigger>
    </div>

    {{-- Modal Gani Foto --}}
    <flux:modal name="gantifoto" class="md:w-96" @close="resetForm">
        <form wire:submit="simpanFoto">
            {{-- Ganti Foto --}}
            <flux:field>
                <flux:label>Pas Foto</flux:label>
                <flux:input class="-mb-3" type="file" wire:model="pasFoto" />
                <flux:description class="text-xs">*JPG, JPEG (max:1024)</flux:description>
                <flux:error name="pasFoto" />
            </flux:field>
            @if ($pasFoto)
                <flux:button type="submit" class="mt-7" variant="primary" color="emerald">
                    Simpan
                </flux:button>
            @else
                <flux:button type="submit" class="mt-7" variant="primary" color="emerald" disabled>
                    Simpan
                </flux:button>
            @endif
        </form>
    </flux:modal>

    {{-- Modal Berkas --}}
    <flux:modal name="berkas" class="md:w-96" @close="resetForm">
        <form wire:submit="simpanBerkas">
            {{-- Berkas --}}
            <div class="grid grid-cols-1 gap-4 overflow-hidden">
                <flux:heading class="text-[1rem] mb-2">Berkas</flux:heading>
                <flux:field>
                    <flux:label>Akta Kelahiran</flux:label>
                    <flux:input class="-mb-3" type="file" wire:model="aktaKelahiran" />
                    <flux:description class="text-xs">*PDF (max:2048)</flux:description>
                    <flux:error name="aktaKelahiran" />
                    <flux:button size="xs" class="w-24 ms-2" variant="primary" color="blue" target="_blank"
                        href="{{ route('berkas.show', [$siswa->no_pendaftaran, basename($siswa->berkas->akta_kelahiran)]) }}">
                        Lihat File
                    </flux:button>
                </flux:field>
                <flux:field>
                    <flux:label>Kartu Keluarga</flux:label>
                    <flux:input class="-mb-3" type="file" wire:model="kartuKeluarga" />
                    <flux:description class="text-xs">*PDF (max:2048)</flux:description>
                    <flux:error name="kartuKeluarga" />
                    <flux:button size="xs" class="w-24 ms-2" variant="primary" color="blue" target="_blank"
                        href="{{ route('berkas.show', [$siswa->no_pendaftaran, basename($siswa->berkas->kartu_keluarga)]) }}">
                        Lihat File
                    </flux:button>
                </flux:field>
            </div>
            @if ($aktaKelahiran || $kartuKeluarga)
                <flux:button type="submit" class="mt-7" variant="primary" color="emerald">
                    Simpan Perubahan
                </flux:button>
            @else
                <flux:button type="submit" class="mt-7" variant="primary" color="emerald" disabled>
                    Simpan Perubahan
                </flux:button>
            @endif
        </form>
    </flux:modal>
</div>
