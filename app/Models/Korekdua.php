<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Koreksatu;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Korekdua extends Model
{
    use HasFactory;

    protected $fillable = [
        'koreksatu_id',
        'code',
        'name'
    ];


    public function koreksatu(): BelongsTo
    {
        return $this->belongsTo(Koreksatu::class);
    }
}
