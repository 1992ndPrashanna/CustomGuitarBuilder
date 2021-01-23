<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bridge extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        'type',
        'strings',
        'color',
        'brand',
        'scale',
        'description'
    ];

    public function bridgeBrand(){
        return $this->hasOne(BridgeBrand::class,'id','brand');
    }

    public function bridgeColor(){
        return $this->hasOne(BridgeColor::class,'id','color');
    }
    
    public function bridgeScale(){
        return $this->hasOne(BridgeScale::class,'id','scale');
    }

    public function bridgeType(){
        return $this->hasOne(BridgeType::class,'id','type');
    }
}
