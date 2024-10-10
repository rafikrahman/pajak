<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Setorpr extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'noreg',
        'title',
        'perusahaan_id',
        'koreksatu_id',
        'korekdua_id',
        'korektiga_id',
        'province_id',
        'regency_id',
        'volume',
        'nilai',
        'tglsetor',
        'keterangan',
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

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    public function regency(): BelongsTo
    {
        return $this->belongsTo(Regency::class);
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function pegawai(): BelongsTo
    {
        return $this->belongsTo(Pegawai::class);
    }
}
