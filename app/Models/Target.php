<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Relation;

class Target extends Model
{
    use HasFactory;

    protected $fillable = [
        'uptd_id',
        'koreksatu_id',
        'korekdua_id',
        'korektiga_id',
        'nilaitarget',
        'tahun',
        'ket'
    ];

    public function uptd(): BelongsTo
    {
        return $this->belongsTo(Uptd::class);
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

    
}
