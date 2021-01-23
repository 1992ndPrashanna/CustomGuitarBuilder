<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StandardColor extends Model
{
    use HasFactory;
    protected $fillable=["type","description"];
}
