<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomInlay extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable =[
        'type',
        'model',
        'images',
        'description'
    ];

    public function guitarModel(){
        return $this->hasOne(Shape::class,'id','model');
    }

}
