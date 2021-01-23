<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable=[
        'first_name',
        'last_name',
        'country',
        'city',
        'street_address',
        'zip_postal_code',
        'email',
        'phone'
    ];
}
