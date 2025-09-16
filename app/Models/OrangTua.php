<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class OrangTua extends Model
{
    use HasUuids;

    protected $table = 'orang_tua';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'siswa_id',
        'hubungan',
        'nama',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'pendidikan',
        'pekerjaan',
        'penghasilan',
        'no_hp'
    ];

    // Mutator + Accessor untuk NIK
    public function setNikAttribute($value)
    {
        $this->attributes['nik_encrypted'] = Crypt::encryptString($value);
        $this->attributes['nik_hash'] = hash('sha256', $value);
    }

    public function getNikAttribute()
    {
        return Crypt::decryptString($this->attributes['nik_encrypted']);
    }

    // Mutator + Accessor untuk No KK
    public function setNoKkAttribute($value)
    {
        $this->attributes['no_kk_encrypted'] = Crypt::encryptString($value);
        $this->attributes['no_kk_hash'] = hash('sha256', $value);
    }

    public function getNoKkAttribute()
    {
        return Crypt::decryptString($this->attributes['no_kk_encrypted']);
    }


    // Relasi
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }
}
