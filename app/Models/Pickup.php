<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pickup extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        'name',
        'brand',
        'position',
        'type',
        'active_passive',
        'conductors',
        'magnet_material',
        'strings',
        'covering',
        'price',
        'description',
        'image_urls',
        'signature_series',
        'signature_artists',
        'website',
        'stock',
    ];

    public function pickupBrand(){
        return $this->hasOne(PickupBrand::class,'id','brand');
    }

    public function pickupPosition(){
        return $this->hasOne(PickupPosition::class,'id','position');
    }

    public function pickupType(){
        return $this->hasOne(PickupType::class,'id','type');
    }

    public function activePassive(){
        return $this->hasOne(ActivePassive::class,'id','active_passive');
    }

    public function pickupMagnet(){
        return $this->hasOne(MagnetMaterial::class,'id','magnet_material');
    }

    public function pickupCovering(){
        return $this->hasOne(PickupCovering::class,'id','covering');
    }


    
}
