<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'brand_id',
        'description',
        'stock',
        'image'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

}
