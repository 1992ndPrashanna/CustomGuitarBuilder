<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PickupBrand extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table='pickup_brands';

    protected $fillable=[
        'brand',
        'brand_image'
    ];
}
