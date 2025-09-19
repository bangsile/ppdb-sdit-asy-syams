<?php

namespace App\Livewire;

use App\Models\OrangTua;
use App\Models\Siswa;
use Illuminate\Validation\Rule;
use Livewire\Component;

class EditPendaftar extends Component
{
    // DATA CALON SISWA
    public $no_pendaftaran;
    public $siswa_id;
    public $nama;
    public $nisn;
    public $nik;
    public $noKK;
    public $jenisKelamin;
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

    public function mount($no_pendaftaran)
    {
        $siswa = Siswa::with(['orangtua'])->where('no_pendaftaran', $no_pendaftaran)->firstOrFail();
        if ($siswa->user_id !== auth()->id())
            abort(404);
        $this->no_pendaftaran = $no_pendaftaran;
        $this->siswa_id = $siswa->id;
        $this->nama = $siswa->nama;
        $this->nisn = $siswa->nisn;
        $this->nik = $siswa->nik;
        $this->noKK = $siswa->noKK;
        $this->jenisKelamin = $siswa->jenis_kelamin;
        $this->tempatLahir = $siswa->tempat_lahir;
        $this->tanggalLahir = $siswa->tanggal_lahir;
        $this->noAktaLahir = $siswa->no_reg_akta;
        $this->tinggiBadan = $siswa->tinggi_badan;
        $this->beratBadan = $siswa->berat_badan;
        $this->lingkarKepala = $siswa->lingkar_kepala;
        $this->citaCita = $siswa->cita_cita;
        $this->hobi = $siswa->hobi;
        $this->kelurahan = $siswa->kelurahan;
        $this->jalan = $siswa->jalan;
        $this->rt = $siswa->rt;
        $this->rw = $siswa->rw;
        $this->jarakRumah = $siswa->jarak_rumah;
        $this->anakKe = $siswa->anak_ke;
        $this->namaAyah = $siswa->orangtua[0]->nama;
        $this->nikAyah = $siswa->orangtua[0]->nik;
        $this->tempatLahirAyah = $siswa->orangtua[0]->tempat_lahir;
        $this->tanggalLahirAyah = $siswa->orangtua[0]->tanggal_lahir;
        $this->pendidikanAyah = $siswa->orangtua[0]->pendidikan;
        $this->pekerjaanAyah = $siswa->orangtua[0]->pekerjaan;
        $this->penghasilanAyah = $siswa->orangtua[0]->penghasilan;
        $this->noHpAyah = $siswa->orangtua[0]->no_hp;
        $this->namaIbu = $siswa->orangtua[1]->nama;
        $this->nikIbu = $siswa->orangtua[1]->nik;
        $this->tempatLahirIbu = $siswa->orangtua[1]->tempat_lahir;
        $this->tanggalLahirIbu = $siswa->orangtua[1]->tanggal_lahir;
        $this->pendidikanIbu = $siswa->orangtua[1]->pendidikan;
        $this->pekerjaanIbu = $siswa->orangtua[1]->pekerjaan;
        $this->penghasilanIbu = $siswa->orangtua[1]->penghasilan;
        $this->noHpIbu = $siswa->orangtua[1]->no_hp;
    }

    public function save()
    {
        $rules = [
            'nama' => 'required',
            'nisn' => [
                'required',
                Rule::unique('siswa', 'nisn')->ignore($this->siswa_id),
            ],
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

            // data ibu
            'namaIbu' => 'required',
            'nikIbu' => 'required',
            'tempatLahirIbu' => 'required',
            'tanggalLahirIbu' => 'required|date',
            'pendidikanIbu' => 'required',
            'pekerjaanIbu' => 'required',
            'penghasilanIbu' => 'required|numeric',
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

        $data = [
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

        Siswa::findOrFail($this->siswa_id)->update($data);

        $ayah = OrangTua::where('siswa_id', $this->siswa_id)
            ->where('hubungan', 'Ayah')
            ->firstOrFail();

        $ayah->update([
            'nama' => $this->namaAyah,
            'nik' => $this->nikAyah,
            'tempat_lahir' => $this->tempatLahirAyah,
            'tanggal_lahir' => $this->tanggalLahirAyah,
            'pendidikan' => $this->pendidikanAyah,
            'pekerjaan' => $this->pekerjaanAyah,
            'penghasilan' => $this->penghasilanAyah,
            'no_hp' => $this->noHpAyah,
        ]);

        $ibu = OrangTua::where('siswa_id', $this->siswa_id)
            ->where('hubungan', 'Ibu')
            ->firstOrFail();

        $ibu->update([
            'nama' => $this->namaIbu,
            'nik' => $this->nikIbu,
            'tempat_lahir' => $this->tempatLahirIbu,
            'tanggal_lahir' => $this->tanggalLahirIbu,
            'pendidikan' => $this->pendidikanIbu,
            'pekerjaan' => $this->pekerjaanIbu,
            'penghasilan' => $this->penghasilanIbu,
            'no_hp' => $this->noHpIbu,
        ]);
        $this->dispatch('show-notification', type: 'success', message: 'Berhasil menyimpan data');
        $this->dispatch('redirect-to', url: route('pendaftaran.detail', $this->no_pendaftaran));
    }

    public function render()
    {
        return view('livewire.edit-pendaftar');
    }
}
