<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'picture', 'price', 'quantity'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
