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
        'email',
        'diskspace',
        'domain',
    ];

    public static function createFromOrder(Order $order, string $password, string $dedikamAccessName, string $email, ?bool $isNextcloud = null, ?string $domain = '')
    {
        return MemberAccess::create([
            'order_id' => $order['id'],
            'password' => $password,
            'email' => $email,
            'name' => $dedikamAccessName,
            'member_access' => $isNextcloud !== null ? ($isNextcloud ? 'Nextcloud' : 'Seafile') : $order->member_access,
            'diskspace' => $order->diskspace,
            'domain' => $domain,
        ]);
    }

    public static function getNextMemberAccessName()
    {
        $memberAccessId = MemberAccess::orderBy('id', 'desc')->value('id') + 1;
        return sprintf("dk%'06d", $memberAccessId);
    }

    public function getAccessName() {
        $order = $this->belongsTo(Order::class, 'order_id')->first();
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

    public static function accessesOfOneUser(int $userId) {
        $orders = Order::where('user_id', $userId)->orderBy('created_at', 'desc')->get();
        $memberAccesses = [];
        foreach ($orders as $order) {
            $memberAccesses[] = MemberAccess::where('order_id', $order->id)->get();
        }
        return $memberAccesses;
    }

    public function getAbonnement() {
        $order = $this->belongsTo(Order::class, 'order_id')->first();
        return $order->mode;
    }
}
