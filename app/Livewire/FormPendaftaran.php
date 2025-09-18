<?php

namespace App\Livewire;

use App\Models\BerkasSiswa;
use App\Models\OrangTua;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class FormPendaftaran extends Component
{
    use WithFileUploads;

    public $step = 1;

    // DATA CALON SISWA
    public $nama;
    public $nisn;
    public $nik;
    public $noKK;
    public $jenisKelamin = "Laki-Laki";
    public $tempatLahir;
    public $tanggalLahir;
    public $noAktaLahir;
    public $tinggiBadan;
    public $beratBadan;
    public $lingkarKepala;
    public $citaCita;
    public $hobi;
    public $kelurahan;
    public $jalan;
    public $rt;
    public $rw;
    public $jarakRumah;
    public $anakKe;

    // DATA ORANG TUA
    public $namaAyah;
    public $nikAyah;
    public $tempatLahirAyah;
    public $tanggalLahirAyah;
    public $pendidikanAyah;
    public $pekerjaanAyah;
    public $penghasilanAyah;
    public $noHpAyah;

    public $namaIbu;
    public $nikIbu;
    public $tempatLahirIbu;
    public $tanggalLahirIbu;
    public $pendidikanIbu;
    public $pekerjaanIbu;
    public $penghasilanIbu;
    public $noHpIbu;

    // BERKAS
    public $aktaKelahiran;
    public $kartuKeluarga;
    public $pasFoto;

    public function nextStep()
    {
        $rules = [
            // data siswa
            'nama' => 'required',
            'nisn' => 'required|unique:siswa,nisn',
            'nik' => 'required|unique:siswa,nik_hash',
            'noKK' => 'required',
            'jenisKelamin' => 'required',
            'tempatLahir' => 'required',
            'tanggalLahir' => 'required|date',
            'noAktaLahir' => 'required',
            'tinggiBadan' => 'required|numeric',
            'beratBadan' => 'required|numeric',
            'lingkarKepala' => 'required|numeric',
            'citaCita' => 'required',
            'hobi' => 'required',
            'kelurahan' => 'required',
            // 'jalan' => '',
            'rt' => 'required',
            'rw' => 'required',
            'jarakRumah' => 'required',
            'anakKe' => 'required',
        ];
        $attributes = [
            // data siswa
            'nama' => 'Nama',
            'nisn' => 'NISN',
            'nik' => 'NIK',
            'noKK' => 'No KK',
            'jenisKelamin' => 'Jenis Kelamin',
            'tempatLahir' => 'Tempat Lahir',
            'tanggalLahir' => 'Tanggal Lahir',
            'noAktaLahir' => 'No Akta Lahir',
            'tinggiBadan' => 'Tinggi Badan',
            'beratBadan' => 'Berat Badan',
            'lingkarKepala' => 'Lingkar Kepala',
            'citaCita' => 'Cita-Cita',
            'hobi' => 'Hobi',
            'kelurahan' => 'Kelurahan',
            'jalan' => 'Jalan',
            'rt' => 'RT',
            'rw' => 'RW',
            'jarakRumah' => 'Jarak Rumah ke Sekolah',
            'anakKe' => 'Anak ke-berapa',
        ];

        $rules += [
            // data ayah
            'namaAyah' => 'required',
            'nikAyah' => 'required',
            'tempatLahirAyah' => 'required',
            'tanggalLahirAyah' => 'required|date',
            'pendidikanAyah' => 'required',
            'pekerjaanAyah' => 'required',
            'penghasilanAyah' => 'required|numeric',
            // 'noHpAyah' => 'required',

            // data ibu
            'namaIbu' => 'required',
            'nikIbu' => 'required',
            'tempatLahirIbu' => 'required',
            'tanggalLahirIbu' => 'required|date',
            'pendidikanIbu' => 'required',
            'pekerjaanIbu' => 'required',
            'penghasilanIbu' => 'required|numeric',
            // 'noHpIbu' => 'required',
        ];
        $attributes += [
            // data ayah
            'namaAyah' => 'Nama Ayah',
            'nikAyah' => 'NIK Ayah',
            'tempatLahirAyah' => 'Tempat Lahir Ayah',
            'tanggalLahirAyah' => 'Tanggal Lahir Ayah',
            'pendidikanAyah' => 'Pendidikan Ayah',
            'pekerjaanAyah' => 'Pekerjaan Ayah',
            'penghasilanAyah' => 'Penghasilan Ayah',
            'noHpAyah' => 'No HP Ayah',

            // data ibu
            'namaIbu' => 'Nama Ibu',
            'nikIbu' => 'NIK Ibu',
            'tempatLahirIbu' => 'Tempat Lahir Ibu',
            'tanggalLahirIbu' => 'Tanggal Lahir Ibu',
            'pendidikanIbu' => 'Pendidikan Ibu',
            'pekerjaanIbu' => 'Pekerjaan Ibu',
            'penghasilanIbu' => 'Penghasilan Ibu',
            'noHpIbu' => 'No HP Ibu',
        ];

        $this->validate($rules, [
            'required' => ':attribute wajib diisi.',
            'unique' => 'Siswa dengan :attribute tersebut sudah terdaftar.',
            'date' => 'Format tanggal tidak valid.',
            'numeric' => ':attribute harus berupa angka.',
        ], $attributes);

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

        $data = [
            'user_id' => Auth::user()->id,
            'nama' => $this->nama,
            'nisn' => $this->nisn,
            'nik' => $this->nik,
            'no_kk' => $this->noKK,
            'jenis_kelamin' => $this->jenisKelamin,
            'tempat_lahir' => $this->tempatLahir,
            'tanggal_lahir' => $this->tanggalLahir,
            'no_reg_akta' => $this->noAktaLahir,
            'tinggi_badan' => $this->tinggiBadan,
            'berat_badan' => $this->beratBadan,
            'lingkar_kepala' => $this->lingkarKepala,
            'cita_cita' => $this->citaCita,
            'hobi' => $this->hobi,
            'jalan' => $this->jalan ?: null,
            'kelurahan' => $this->kelurahan,
            'rt_rw' => $this->rt . '/' . $this->rw,
            'jarak_rumah' => $this->jarakRumah,
            'anak_ke' => $this->anakKe,
        ];

        $siswa = Siswa::create($data);

        OrangTua::create([
            'siswa_id' => $siswa->id,
            'hubungan' => 'Ayah',
            'nama' => $this->namaAyah,
            'nik' => $this->nikAyah,
            'tempat_lahir' => $this->tempatLahirAyah,
            'tanggal_lahir' => $this->tanggalLahirAyah,
            'pendidikan' => $this->pendidikanAyah,
            'pekerjaan' => $this->pekerjaanAyah,
            'penghasilan' => $this->penghasilanAyah,
            'no_hp' => $this->noHpAyah
        ]);
        OrangTua::create([
            'siswa_id' => $siswa->id,
            'hubungan' => 'Ibu',
            'nama' => $this->namaIbu,
            'nik' => $this->nikIbu,
            'tempat_lahir' => $this->tempatLahirIbu,
            'tanggal_lahir' => $this->tanggalLahirIbu,
            'pendidikan' => $this->pendidikanIbu,
            'pekerjaan' => $this->pekerjaanIbu,
            'penghasilan' => $this->penghasilanIbu,
            'no_hp' => $this->noHpIbu
        ]);

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
