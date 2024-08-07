<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    const TYPE_PERCENT = 'percent';
    const TYPE_PRICE = 'price';

    protected $fillable = [
        'code',
        'discount',
        'type',
        'description',
        'expiry',
        'limit',
    ];
}
