<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActivePassive extends Model
{
    use HasFactory;
    use SoftDeletes;

    
    protected $fillable = [
        'type',
        'description'
    ];
}
