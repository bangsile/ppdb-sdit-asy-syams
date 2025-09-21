<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class UangPangkal extends Model
{
    use HasUuids;

    protected $table = 'uang_pangkal';

    protected $fillable = ['uraian', 'nominal'];
}
