<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tuner extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function tunerBrand(){
        return $this->hasOne(TunerBrand::class,'id','brand');
    }

}
