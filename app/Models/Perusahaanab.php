<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Perusahaanab extends Model
{
    use HasFactory;

    protected $fillable = [
        'iden',
        'noreg',
        'name',
        'uptd_id',
        'alamat',
        'province_id',
        'regency_id',
        'district_id',
        'email',
        'website',
        'namekontak',
        'ponsel',
        'emailkontak',
        'koreksatu_id',
        'status'
    ];

    public function uptd(): BelongsTo
    {
        return $this->belongsTo(Uptd::class);
    }

    public function koreksatu(): BelongsTo
    {
        return $this->belongsTo(Koreksatu::class);
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
}
