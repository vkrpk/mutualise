<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MemberAccess extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'password',
        'member_access',
        'name',
        'diskspace'
    ];

    public static function createFromOrder(Order $order, string $password)
    {
        return MemberAccess::create([
            'order_id' => $order['id'],
            'password' => $password,
            'name' => self::getNextMemberAccessName(),
            'member_access' => $order->member_access,
            'diskspace' => $order->diskspace
        ]);
    }

    public static function getNextMemberAccessName()
    {
        $memberAccessId = MemberAccess::orderBy('id', 'desc')->value('id') + 1;
        return sprintf("dk%'06d", $memberAccessId);
    }

    public function getAccessName() {
        // dd($this);
        $order = $this->belongsTo(Order::class, 'order_id')->first();
        // dd($order);
        return $order->access_name;
    }

    public function getFormula() {
        $order = $this->belongsTo(Order::class, 'order_id')->first();
        $formula_id = $order->formula_id;
        return Formula::find($formula_id);
    }

    /**
     * @return User
     */
    public function getUser() {
        $order = $this->belongsTo(Order::class, 'order_id')->first();
        $user_id = $order->user_id;
        return User::find($user_id);
    }
}
