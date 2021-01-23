<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        'orderUUID',
        'user_email',
        'price',
        'due',
        'advanced_payment'
    ];

    public function getCustomer(){
        return $this->hasOne(Customer::class,'email','user_email');
    }

    public function getCustomOrder(){
        return $this->hasOne(CustomOrder::class,'orderUUID','orderUUID');
    }
}
