<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasUuids;

    protected $table = 'berkas_siswa';
    protected $fillable = ['siswa_id', 'status_bayar', 'sisa_cicilan'];

    // Relasi
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }
}
