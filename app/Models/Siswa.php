<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class Siswa extends Model
{
    use HasUuids, SoftDeletes;
    
    protected $table = 'siswa';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'no_pendaftaran',
        'nama',
        'jenis_kelamin',
        'nisn',
        'nik',
        'no_kk',
        'tempat_lahir',
        'tanggal_lahir',
        'no_reg_akta',
        'tinggi_badan',
        'berat_badan',
        'lingkar_kepala',
        'cita_cita',
        'hobi',
        'jalan',
        'kelurahan',
        'rt_rw',
        'jarak_rumah',
        'anak_ke',
        'status',
        'user_id'
    ];

    // Boot method untuk UUID & no_pendaftaran
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            // Auto-generate no_pendaftaran (cth: 2025-0001)
            $tahun = now()->year;
            $count = self::whereYear('created_at', $tahun)->count() + 1;
            $model->no_pendaftaran = sprintf("%s-%04d", $tahun, $count);
        });
    }

    // Scope
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

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

    // Mutator + Accessor untuk No Reg Akta
    public function setNoRegAktaAttribute($value)
    {
        $this->attributes['no_reg_akta_encrypted'] = Crypt::encryptString($value);
        $this->attributes['no_reg_akta_hash'] = hash('sha256', $value);
    }

    public function getNoRegAktaAttribute()
    {
        return Crypt::decryptString($this->attributes['no_reg_akta_encrypted']);
    }

    // Relasi
    public function orangTua()
    {
        return $this->hasMany(OrangTua::class, 'siswa_id', 'id');
    }

    public function berkas()
    {
        return $this->hasMany(BerkasSiswa::class, 'siswa_id', 'id');
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'siswa_id', 'id');
    }
}
