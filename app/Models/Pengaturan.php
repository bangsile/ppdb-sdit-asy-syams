<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    use HasUuids;

    protected $table = 'pengaturan';

    protected $fillable = [
        'no_rek',
        'atas_nama_rek',
        'nama_bank'
    ];
}
