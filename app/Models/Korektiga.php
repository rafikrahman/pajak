<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Korektiga extends Model
{
    use HasFactory;

    protected $fillable = [
        'korekdua_id',
        'code',
        'name'
    ];


    public function korekdua(): BelongsTo
    {
        return $this->belongsTo(Korekdua::class);
    }
}
