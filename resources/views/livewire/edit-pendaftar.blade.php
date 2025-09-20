<div>
    <flux:heading class="text-xl mb-2">Edit Data</flux:heading>
    <flux:separator variant="subtle" />

    <x-notification class="fixed z-50 right-5 bottom-5" />

    <form class="mt-10 max-w-7xl" wire:submit="save">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 content-start">
            {{-- Data Peserta Didik --}}
            <div class="grid grid-cols-1 gap-4 content-start">
                <flux:heading class="text-[1rem] mb-2">Data Peserta Didik</flux:heading>
                <flux:input label="Nama" wire:model="siswa.nama" />
                <flux:input label="NISN" wire:model="siswa.nisn" />
                <flux:input label="NIK" wire:model="siswa.nik" />
                <flux:input label="No. KK" wire:model="siswa.no_kk" />

                <flux:field>
                    <flux:label>Jenis Kelamin</flux:label>

                    <flux:select wire:model="siswa.jenis_kelamin" placeholder="Pilih Jenis Kelamin">
                        <flux:select.option>Laki-Laki</flux:select.option>
                        <flux:select.option>Perempuan</flux:select.option>
                    </flux:select>

                    <flux:error name="jenis_kelamin" />
                </flux:field>

                <flux:input label="Tempat Lahir" wire:model="siswa.tempat_lahir" />
                <flux:input label="Tanggal Lahir" wire:model="siswa.tanggal_lahir" type="date" />
                <flux:input label="No. Akta Lahir" wire:model="siswa.no_reg_akta" />
                <flux:input label="Anak ke-berapa" wire:model="siswa.anak_ke" type="number" min=1 />
                <div class="grid grid-cols-3 gap-1 items-end">
                    <flux:input label="Tinggi Badan" wire:model="siswa.tinggi_badan" />
                    <flux:input label="Berat Badan" wire:model="siswa.berat_badan" />
                    <flux:input label="Lingkar Kepala" wire:model="siswa.lingkar_kepala" />
                </div>
                <flux:input label="Cita-Cita" wire:model="siswa.cita_cita" />
                <flux:input label="Hobi" wire:model="siswa.hobi" />

                <flux:heading class="mt-2">Alamat</flux:heading>
                <flux:input label="Jalan" wire:model="siswa.jalan" />
                <div class="grid grid-cols-4 gap-1">
                    <div class="col-span-2">
                        <flux:input label="Kelurahan" wire:model="siswa.kelurahan" />
                    </div>
                    <flux:input label="RT" wire:model="siswa.rt" />
                    <flux:input label="RW" wire:model="siswa.rw" />
                </div>
                <flux:input label="Jarak rumah ke sekolah (km)" wire:model="siswa.jarak_rumah" type="number" min=0 />
            </div>

            {{-- Data Orang Tua --}}
            <div class="grid grid-cols-1 gap-4 content-start">
                <flux:heading class="text-[1rem] mb-2">Data Orang Tua</flux:heading>
                <flux:input label="Nama Ayah" wire:model="ayah.nama" />
                <flux:input label="NIK Ayah" wire:model="ayah.nik" />
                <flux:input label="Tempat Lahir Ayah" wire:model="ayah.tempat_lahir" />
                <flux:input label="Tanggal Lahir" wire:model="ayah.tanggal_lahir" type="date" />
                <flux:input label="Pendidikan Ayah" wire:model="ayah.pendidikan" />
                <flux:input label="Pekerjaan Ayah" wire:model="ayah.pekerjaan" />
                <flux:input label="Penghasilan Ayah" wire:model="ayah.penghasilan" type="number" min=0 />
                <flux:input label="No. HP Ayah" wire:model="ayah.no_hp" />

                <flux:input label="Nama Ibu" wire:model="ibu.nama" />
                <flux:input label="NIK Ibu" wire:model="ibu.nik" />
                <flux:input label="Tempat Lahir Ibu" wire:model="ibu.tempat_lahir" />
                <flux:input label="Tanggal Lahir" wire:model="ibu.tanggal_lahir" type="date" />
                <flux:input label="Pendidikan Ibu" wire:model="ibu.pendidikan" />
                <flux:input label="Pekerjaan Ibu" wire:model="ibu.pekerjaan" />
                <flux:input label="Penghasilan Ibu" wire:model="ibu.penghasilan" type="number" min=0 />
                <flux:input label="No. HP Ibu" wire:model="ibu.no_hp" />

            </div>
        </div>
        <div class="flex items-center justify-end gap-5 mt-5">
            @if ($errors->any())
                <p class="text-sm text-red-600">Gagal. Harap isi formulir dengan benar.</p>
            @endif
            <flux:button type="submit" class="float-t" variant="primary" color="emerald">
                Simpan
            </flux:button>
        </div>
    </form>

    <script>
        Livewire.on('redirect-to', ({
            url
        }) => {
            setTimeout(() => Livewire.navigate(url), 1500)
        })
    </script>
</div>
