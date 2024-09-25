<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'item_id', 'totalPrice', 'date'];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
