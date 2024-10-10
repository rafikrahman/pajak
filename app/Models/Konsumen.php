<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Konsumen extends Model
{
    use HasFactory;

    protected $fillable = [
        'iden',
        'noreg',
        'name',
        'alamat',
        'province_id',
        'regency_id',
        'district_id',
        'namekontak',
        'ponsel',
        'emailkontak',
        'status'
    ];

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
