<div>
    <flux:heading class="text-xl mb-2">Formulir Pendaftaran</flux:heading>
    <flux:separator variant="subtle" />

    @if ($step == 1)
        <form class="mt-10 max-w-7xl" wire:submit="nextStep">
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

                        <flux:select wire:model="siswa.jenis_kelamin">
                            <flux:select.option disabled value="">Pilih Jenis Kelamin</flux:select.option>
                            <flux:select.option value="Laki-Laki">Laki-Laki</flux:select.option>
                            <flux:select.option value="Perempuan">Perempuan</flux:select.option>
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
                    <flux:input label="Jarak rumah ke sekolah (km)" wire:model="siswa.jarak_rumah" type="number"
                        min=0 />
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
            <flux:button type="submit" class="mt-5 float-right" variant="primary" color="emerald">
                Selanjutnya
            </flux:button>
        </form>
    @endif
    @if ($step == 2)
        <form class="mt-10" wire:submit="save">
            {{-- Data Peserta Didik --}}
            <div class="grid grid-cols-1 gap-4 overflow-hidden">
                <flux:heading class="text-[1rem] mb-2">Berkas</flux:heading>
                <flux:field>
                    <flux:label>Akta Kelahiran</flux:label>
                    <flux:input class="-mb-3" type="file" wire:model="aktaKelahiran" />
                    <flux:description class="text-xs">*PDF (max:2048)</flux:description>
                    <flux:error name="aktaKelahiran" />
                </flux:field>
                <flux:field>
                    <flux:label>Kartu Keluarga</flux:label>
                    <flux:input class="-mb-3" type="file" wire:model="kartuKeluarga" />
                    <flux:description class="text-xs">*PDF (max:2048)</flux:description>
                    <flux:error name="kartuKeluarga" />
                </flux:field>
                <flux:field>
                    <flux:label>Pas Foto</flux:label>
                    <flux:input class="-mb-3" type="file" wire:model="pasFoto" />
                    <flux:description class="text-xs">*JPG, JPEG (max:1024)</flux:description>
                    <flux:error name="pasFoto" />
                </flux:field>

            </div>
            <div class="flex gap-3">
                <flux:button type="button" wire:click="$set('step', '1')" class="mt-7">
                    Kembali
                </flux:button>
                <flux:button type="submit" class="mt-7" variant="primary" color="emerald">
                    Simpan
                </flux:button>
            </div>
        </form>
    @endif
</div>
