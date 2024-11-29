<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Contact;
use App\Models\PaymentMethod;
use App\Models\Coupon;
use App\Models\OrderStatus;
use App\Models\OrderItem;
use App\Models\admin\Notification;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'order_id';

    protected $fillable = [
        'users_id',
        'contact_id',
        'payment_method_id',
        'coupon_id',
        'total',
        'is_payment_status',
        'price_ship',
        'order_date',
        'order_status_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class, 'contact_id');
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class, 'coupon_id');
    }

    public function status()
    {
        return $this->belongsTo(OrderStatus::class, 'order_status_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'order_id_noti');
    }
}
