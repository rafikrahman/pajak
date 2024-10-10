<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kualitasair extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'level',
        'nilai',
        'uraian',
        'action',
    ];
}
