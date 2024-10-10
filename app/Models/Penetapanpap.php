<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penetapanpap extends Model
{
    use HasFactory;

    protected $fillable = [
        'iden',
        'noreg',
        'perusahaan_id',
        'uptd_id',
        'koreksatu_id',
        'korekdua_id',
        'korektiga_id',
        'kualitasair_id',
        'volumepap',
        'nilaipap',
        'tglsetor',
        'image',
        'pegawai_id'
    ];


    public function perusahaan(): BelongsTo
    {
        return $this->belongsTo(Perusahaan::class);
    }

    public function koreksatu(): BelongsTo
    {
        return $this->belongsTo(Koreksatu::class);
    }

    public function korekdua(): BelongsTo
    {
        return $this->belongsTo(Korekdua::class);
    }

    public function korektiga(): BelongsTo
    {
        return $this->belongsTo(Korektiga::class);
    }

    public function kualitasair(): BelongsTo
    {
        return $this->belongsTo(Kualitasair::class);
    }

    public function pegawai(): BelongsTo
    {
        return $this->belongsTo(Pegawai::class);
    }

    public function uptd(): BelongsTo
    {
        return $this->belongsTo(Uptd::class);
    }
}
