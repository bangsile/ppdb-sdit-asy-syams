<div>
    <flux:heading class="text-xl mb-2">Edit Data</flux:heading>
    <flux:separator variant="subtle" />

    <x-notification class="fixed z-50 right-5 bottom-5" />

    <form class="mt-10 max-w-7xl" wire:submit="save">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 content-start">
            {{-- Data Peserta Didik --}}
            <div class="grid grid-cols-1 gap-4 content-start">
                <flux:heading class="text-[1rem] mb-2">Data Peserta Didik</flux:heading>
                <flux:input label="Nama" wire:model="nama" />
                <flux:input label="NISN" wire:model="nisn" />
                <flux:input label="NIK" wire:model="nik" />
                <flux:input label="No. KK" wire:model="noKK" />

                <flux:field>
                    <flux:label>Jenis Kelamin</flux:label>

                    <flux:select wire:model="jenisKelamin" placeholder="Pilih Jenis Kelamin">
                        <flux:select.option>Laki-Laki</flux:select.option>
                        <flux:select.option>Perempuan</flux:select.option>
                    </flux:select>

                    <flux:error name="jenisKelamin" />
                </flux:field>

                <flux:input label="Tempat Lahir" wire:model="tempatLahir" />
                <flux:input label="Tanggal Lahir" wire:model="tanggalLahir" type="date" />
                <flux:input label="No. Akta Lahir" wire:model="noAktaLahir" />
                <flux:input label="Anak ke-berapa" wire:model="anakKe" type="number" min=1 />
                <div class="grid grid-cols-3 gap-1 items-end">
                    <flux:input label="Tinggi Badan" wire:model="tinggiBadan" />
                    <flux:input label="Berat Badan" wire:model="beratBadan" />
                    <flux:input label="Lingkar Kepala" wire:model="lingkarKepala" />
                </div>
                <flux:input label="Cita-Cita" wire:model="citaCita" />
                <flux:input label="Hobi" wire:model="hobi" />

                <flux:heading class="mt-2">Alamat</flux:heading>
                <flux:input label="Jalan" wire:model="jalan" />
                <div class="grid grid-cols-4 gap-1">
                    <div class="col-span-2">
                        <flux:input label="Kelurahan" wire:model="kelurahan" />
                    </div>
                    <flux:input label="RT" wire:model="rt" />
                    <flux:input label="RW" wire:model="rw" />
                </div>
                <flux:input label="Jarak rumah ke sekolah (km)" wire:model="jarakRumah" type="number" min=0 />
            </div>

            {{-- Data Orang Tua --}}
            <div class="grid grid-cols-1 gap-4 content-start">
                <flux:heading class="text-[1rem] mb-2">Data Orang Tua</flux:heading>
                <flux:input label="Nama Ayah" wire:model="namaAyah" />
                <flux:input label="NIK Ayah" wire:model="nikAyah" />
                <flux:input label="Tempat Lahir Ayah" wire:model="tempatLahirAyah" />
                <flux:input label="Tanggal Lahir" wire:model="tanggalLahirAyah" type="date" />
                <flux:input label="Pendidikan Ayah" wire:model="pendidikanAyah" />
                <flux:input label="Pekerjaan Ayah" wire:model="pekerjaanAyah" />
                <flux:input label="Penghasilan Ayah" wire:model="penghasilanAyah" type="number" min=0 />
                <flux:input label="No. HP Ayah" wire:model="noHpAyah" />

                <flux:input label="Nama Ibu" wire:model="namaIbu" />
                <flux:input label="NIK Ibu" wire:model="nikIbu" />
                <flux:input label="Tempat Lahir Ibu" wire:model="tempatLahirIbu" />
                <flux:input label="Tanggal Lahir" wire:model="tanggalLahirIbu" type="date" />
                <flux:input label="Pendidikan Ibu" wire:model="pendidikanIbu" />
                <flux:input label="Pekerjaan Ibu" wire:model="pekerjaanIbu" />
                <flux:input label="Penghasilan Ibu" wire:model="penghasilanIbu" type="number" min=0 />
                <flux:input label="No. HP Ibu" wire:model="noHpIbu" />

            </div>
        </div>
        <flux:button type="submit" class="mt-5 float-right" variant="primary" color="emerald">
            Simpan
        </flux:button>
    </form>

    <script>
        Livewire.on('redirect-to', ({
            url
        }) => {
            setTimeout(() => Livewire.navigate(url), 1500)
        })
    </script>
</div>
