<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Koreksatu extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'inisial',
        'name'
    ];

    public function korekdua(): BelongsTo
    {
        return $this->belongsToMany(Korekdua::class);
    }

    public function taget(): BelongsTo
    {
        return $this->belongsToMany(Taget::class);
    }

}
