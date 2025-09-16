<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BerkasSiswa extends Model
{
    use HasUuids;
    
    protected $table = 'berkas_siswa';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = ['siswa_id', 'akta_kelahiran', 'kartu_keluarga', 'pas_foto'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }
}
