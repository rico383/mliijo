<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'name',
        'email',
        'method',
        'number',
        'address',
        'total_products',
        'total_price',
        'order_time',
        'event_time',
        'order_status',
        'proof_payment',
        'payment_status'
    ];
}