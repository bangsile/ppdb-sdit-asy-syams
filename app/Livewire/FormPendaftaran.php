<?php

namespace App\Livewire;

use App\Models\BerkasSiswa;
use App\Models\OrangTua;
use App\Models\Siswa;
use App\Traits\SiswaValidation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class FormPendaftaran extends Component
{
    use WithFileUploads, SiswaValidation;

    public $step = 1;

    public $siswa = ['id' => '', 'jenis_kelamin' => ''];
    public $ayah = [];
    public $ibu = [];

    // BERKAS
    public $aktaKelahiran;
    public $kartuKeluarga;
    public $pasFoto;

    public function nextStep()
    {
        $this->validate();

        return $this->step = 2;
    }

    public function save()
    {
        $this->validate([
            'aktaKelahiran' => 'required|mimes:pdf|max:2048',
            'kartuKeluarga' => 'required|mimes:pdf|max:2048',
            'pasFoto' => 'required|image|mimes:jpg,jpeg|max:1024'
        ], [
            'required' => ':attribute wajib diisi.',
            'mimes' => 'Format file salah.',
            'max' => 'Ukuran file terlalu besar.',
            'image' => 'File harus berupa gambar.'
        ], [
            'aktaraKelahiran' => 'Akta kelahiran',
            'kartuKeluarga' => 'Kartu keluarga',
            'pasFoto' => 'Pas foto',
        ]);

        $this->siswa['user_id'] = Auth::id();
        $this->siswa['rt_rw'] = $this->siswa['rt'] . '/' . $this->siswa['rw'];
        $siswa = Siswa::create($this->siswa);

        $this->ayah['siswa_id'] = $siswa->id;
        $this->ayah['hubungan'] = 'Ayah';
        OrangTua::create($this->ayah);

        $this->ibu['siswa_id'] = $siswa->id;
        $this->ibu['hubungan'] = 'Ibu';
        OrangTua::create($this->ibu);

        $pathAkta = $this->aktaKelahiran->store("berkas-siswa/{$siswa->no_pendaftaran}");
        $pathKk = $this->kartuKeluarga->store("berkas-siswa/{$siswa->no_pendaftaran}");
        $pathFoto = $this->pasFoto->store("berkas-siswa/{$siswa->no_pendaftaran}");

        BerkasSiswa::create([
            'siswa_id' => $siswa->id,
            'akta_kelahiran' => $pathAkta,
            'kartu_keluarga' => $pathKk,
            'pas_foto' => $pathFoto
        ]);

        return $this->redirect(route('pendaftaran.detail', $siswa->no_pendaftaran), true);
    }

    public function render()
    {
        return view('livewire.form-pendaftaran');
    }
}
