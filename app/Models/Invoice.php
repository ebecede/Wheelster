<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'amount',
        'paymentDate',
    ];

    public function orders()
    {
        return $this->belongsTo(Order::class);
    }


}
