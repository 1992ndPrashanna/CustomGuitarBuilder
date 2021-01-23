<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fret extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        'type',
        'brand',
        'description'
    ];

    public function fretBrand(){
        return $this->hasOne(FretBrand::class,'id','brand');
    }
    
}
