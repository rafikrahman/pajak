<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pegawai extends Model
{
    use HasFactory;

    protected $fillable = [
        'uptd_id',
        'jabatan_id',
        'name',
        'nip',
        'gender',
        'golongan',
        'status',
        'statusjabatan',
        'masakerja'
    ];

    public function jabatan(): BelongsTo
    {
        return $this->belongsTo(Jabatan::class);
    }

    public function uptd(): BelongsTo
    {
        return $this->belongsTo(Uptd::class);
    }
}
