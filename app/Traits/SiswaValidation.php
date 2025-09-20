<?php

namespace App\Traits;

use App\Models\Siswa;
use Illuminate\Validation\Rule;

trait SiswaValidation
{
    protected function rules()
    {
        return [
            // Rules Siswa
            'siswa.nama' => 'required',
            'siswa.nisn' => [
                'required',
                Rule::unique('siswa', 'nisn')->ignore($this->siswa['id']),
            ],
            'siswa.nik' => [
                'required',
                // Custom rule: cek ke kolom nik_hash
                function ($attribute, $value, $fail) {
                    $hash = hash('sha256', $value);

                    if (
                        Siswa::where('nik_hash', $hash)
                            ->where('id', '!=', $this->siswa['id'])
                            ->exists()
                    ) {
                        $fail('Siswa dengan NIK tersebut sudah terdaftar.');
                    }
                }
            ],
            'siswa.no_kk' => 'required',
            'siswa.jenis_kelamin' => 'required',
            'siswa.tempat_lahir' => 'required',
            'siswa.tanggal_lahir' => 'required|date',
            'siswa.no_reg_akta' => [
                'required',
                // Custom rule: cek ke kolom no_reg_akta_hash
                function ($attribute, $value, $fail) {
                    $hash = hash('sha256', $value);

                    if (
                        Siswa::where('no_reg_akta_hash', $hash)
                            ->where('id', '!=', $this->siswa['id'])
                            ->exists()
                    ) {
                        $fail('Siswa dengan No. Akta Lahir tersebut sudah terdaftar.');
                    }
                }
            ],
            'siswa.tinggi_badan' => 'required|numeric',
            'siswa.berat_badan' => 'required|numeric',
            'siswa.lingkar_kepala' => 'required|numeric',
            'siswa.cita_cita' => 'required',
            'siswa.hobi' => 'required',
            'siswa.kelurahan' => 'required',
            'siswa.rt' => 'required',
            'siswa.rw' => 'required',
            'siswa.jarak_rumah' => 'required',
            'siswa.anak_ke' => 'required',

            // Rules Ayah
            'ayah.nama' => 'required',
            'ayah.nik' => 'required',
            'ayah.tempat_lahir' => 'required',
            'ayah.tanggal_lahir' => 'required|date',
            'ayah.pendidikan' => 'required',
            'ayah.pekerjaan' => 'required',
            'ayah.penghasilan' => 'required|numeric',

            // Rules Ibu
            'ibu.nama' => 'required',
            'ibu.nik' => 'required',
            'ibu.tempat_lahir' => 'required',
            'ibu.tanggal_lahir' => 'required|date',
            'ibu.pendidikan' => 'required',
            'ibu.pekerjaan' => 'required',
            'ibu.penghasilan' => 'required|numeric',
        ];
    }

    protected function messages()
    {
        return [
            'required' => ':attribute wajib diisi.',
            'unique' => 'Siswa dengan :attribute tersebut sudah terdaftar.',
            'date' => 'Format tanggal tidak valid.',
            'numeric' => ':attribute harus berupa angka.',
        ];
    }

    protected function attributes()
    {
        return [
            // Attributes Siswa
            'siswa.nama' => 'Nama',
            'siswa.nisn' => 'NISN',
            'siswa.nik' => 'NIK',
            'siswa.no_kk' => 'No KK',
            'siswa.jenis_kelamin' => 'Jenis Kelamin',
            'siswa.tempat_lahir' => 'Tempat Lahir',
            'siswa.tanggal_lahir' => 'Tanggal Lahir',
            'siswa.no_reg_akta' => 'No Akta Lahir',
            'siswa.tinggi_badan' => 'Tinggi Badan',
            'siswa.berat_badan' => 'Berat Badan',
            'siswa.lingkar_kepala' => 'Lingkar Kepala',
            'siswa.cita_cita' => 'Cita-Cita',
            'siswa.hobi' => 'Hobi',
            'siswa.kelurahan' => 'Kelurahan',
            'siswa.jalan' => 'Jalan',
            'siswa.rt' => 'RT',
            'siswa.rw' => 'RW',
            'siswa.jarak_rumah' => 'Jarak Rumah ke Sekolah',
            'siswa.anak_ke' => 'Anak ke-berapa',

            // Attributes Ayah
            'ayah.nama' => 'Nama Ayah',
            'ayah.nik' => 'NIK Ayah',
            'ayah.tempat_lahir' => 'Tempat Lahir Ayah',
            'ayah.tanggal_lahir' => 'Tanggal Lahir Ayah',
            'ayah.pendidikan' => 'Pendidikan Ayah',
            'ayah.pekerjaan' => 'Pekerjaan Ayah',
            'ayah.penghasilan' => 'Penghasilan Ayah',
            'ayah.no_hp' => 'No HP Ayah',

            // Attributes Ibu
            'ibu.nama' => 'Nama Ibu',
            'ibu.nik' => 'NIK Ibu',
            'ibu.tempat_lahir' => 'Tempat Lahir Ibu',
            'ibu.tanggal_lahir' => 'Tanggal Lahir Ibu',
            'ibu.pendidikan' => 'Pendidikan Ibu',
            'ibu.pekerjaan' => 'Pekerjaan Ibu',
            'ibu.penghasilan' => 'Penghasilan Ibu',
            'ibu.no_hp' => 'No HP Ibu',
        ];
    }

    // 🔑 Override validate() bawaan Livewire
    public function validate($rules = null, $messages = [], $attributes = [])
    {
        return parent::validate(
            $rules ?? $this->rules(),
            $messages ?: $this->messages(),
            $attributes ?: $this->attributes()
        );
    }
}
