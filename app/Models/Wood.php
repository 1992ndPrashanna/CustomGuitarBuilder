<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wood extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'type',
        'is_body',
        'is_neck',
        'is_top',
        'is_fretboard',
        'description'
    ];
}
