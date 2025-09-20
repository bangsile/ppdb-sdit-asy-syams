<?php

namespace App\Livewire;

use App\Models\Siswa;
use App\Traits\SiswaValidation;
use Livewire\Component;

class EditPendaftar extends Component
{
    use SiswaValidation;

    public $siswaId;
    public $siswa = [];
    public $ayah = [];
    public $ibu = [];

    public function mount($no_pendaftaran)
    {
        $siswa = Siswa::where('no_pendaftaran', $no_pendaftaran)->firstOrFail();
        $this->siswaId = $siswa->id;
        $this->siswa = $siswa->toArray();
        $this->siswa['nik'] = $siswa->nik;
        $this->siswa['no_kk'] = $siswa->no_kk;
        $this->siswa['no_reg_akta'] = $siswa->no_reg_akta;

        $ayah = $siswa->orangtua()->hubungan('Ayah')->first();
        $ibu = $siswa->orangtua()->hubungan('Ibu')->first();

        $this->ayah = $ayah->toArray();
        $this->ayah['nik'] = $ayah->nik;

        $this->ibu = $ibu->toArray();
        $this->ibu['nik'] = $ibu->nik;
    }

    public function save()
    {
        $this->validate();

        // Update siswa
        $this->siswa['rt_rw'] = $this->siswa['rt'] . '/' . $this->siswa['rw'];
        $siswa = Siswa::findOrFail($this->siswaId);
        $siswa->fill($this->siswa);
        $siswa->save();

        // Update ayah
        $ayah = $siswa->orangtua()->hubungan('Ayah')->first();
        $ayah->fill($this->ayah);
        $ayah->hubungan = 'Ayah';
        $ayah->siswa_id = $this->siswaId;
        $ayah->save();

        // Update ibu
        $ibu = $siswa->orangtua()->hubungan('Ibu')->first();
        $ibu->fill($this->ibu);
        $ibu->hubungan = 'Ibu';
        $ibu->siswa_id = $this->siswaId;
        $ibu->save();

        $this->dispatch('show-notification', type: 'success', message: 'Berhasil menyimpan data');
        $this->dispatch('redirect-to', url: route('pendaftaran.detail', $siswa->no_pendaftaran));
    }

    public function render()
    {
        return view('livewire.edit-pendaftar');
    }
}
