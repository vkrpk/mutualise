<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'order_address_id',
        'formula_id',
        'coupon_id',
        'payment_intent',
        'diskspace',
        'mode',
        'member_access',
        'access_name',
        'expire',
        'total_paid',
        'includes_adhesion',
        'comment',
        'payment_mode',
        'status'
    ];

    public static function getAllCreateadAtDesc() {
        return Order::orderBy('created_at', 'desc')->get();
    }
}
