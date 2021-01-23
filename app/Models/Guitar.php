<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guitar extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
       'shape',
        'body_wood',
        'top_wood',
        'neck_pieces',
        'neck_woods',
        'fret_wood',
        'neck_type',
        'frets_type',
        'inlays',
        'custom_inlay_option',
        'fret_count',
        'fret_radius',
        'scale_length',
        'pickup_configuration',
        'neck_pickup',
        'middle_pickup',
        'bridge_pickup',
        'bridge',
        'electronics',
        'nut',
        'pickup_selector',
        'body_finish',
        'top_finish',
        'neck_finish',
        'image_urls',
        'natural_finish',
        'standard_color',
        'translucent_color'
    ];

    public function model(){
        return $this->hasOne(Shape::class,'id','shape');
    }

    public function bodyWood(){
        return $this->hasOne(Wood::class,'id','body_wood');
    }

    public function topWood(){
        return $this->hasOne(Wood::class,'id','top_wood');
    }

    public function neckWoods(){
        return $this->hasOne(Neck::class,'id','neck_woods');
    }

    public function fretboardWood(){
        return $this->hasOne(Wood::class,'id','fret_wood');
    }

    public function fretsType(){
        return $this->hasOne(Fret::class,'id','frets_type');
    }

    public function neckInlays(){
        return $this->hasOne(Inlay::class,'id','inlays');
    }
    
    public function neckType(){
        return $this->hasOne(NeckType::class,'id','neck_type');
    }

    public function customInlayOption(){
        return $this->hasOne(CustomInlay::class,'id','custom_inlay_option');
    }

    public function fretRadius(){
        return $this->hasOne(FretboardRadius::class,'id','fret_radius');
    }

    public function scaleLength(){
        return $this->hasOne(ScaleLength::class,'id','scale_length');
    }

    public function pickupConfiguration(){
        return $this->hasOne(PickupConfiguration::class,'id','pickup_configuration');
    }

    public function neckPickup(){
        return $this->hasOne(Pickup::class,'id','neck_pickup');
    }

    public function middlePickup(){
        return $this->hasOne(Pickup::class,'id','middle_pickup');
    }

    public function bridgePickup(){
        return $this->hasOne(Pickup::class,'id','bridge_pickup');
    }

    public function guitarBridge(){
        return $this->hasOne(Bridge::class,'id','bridge');
    }

    public function guitarElectronics(){
        return $this->hasOne(Electronic::class,'id','electronics');
    }

    public function guitarNut(){
        return $this->hasOne(Nut::class,'id','nut');
    }

    public function pickupSelector(){
        return $this->hasOne(PickupSelector::class,'id','pickup_selector');
    }
    
    
    public function bodyFinish(){
        return $this->hasOne(Finish::class,'id','body_finish');
    }

    public function topFinish(){
        return $this->hasOne(Finish::class,'id','top_finish');
    }

    public function neckFinish(){
        return $this->hasOne(Finish::class,'id','neck_finish');
    }

    public function standardColor(){
        return $this->hasOne(StandardColor::class,'id','standard_color');
    }
    
    public function transColor(){
        return $this->hasOne(TranslucentColor::class,'id','translucent_color');
    }
}
