<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'status',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'payment_method',
        'subtotal',
        'shipping',
        'tax',
        'total',
        'notes',
    ];


    protected $casts = [
        'total' => 'decimal:2',
    ];


    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}