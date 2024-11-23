<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $table = 'coupons';
    protected $primaryKey = 'coupon_id';

    protected $fillable = [
        'code',
        'discount',
        'start_date',
        'end_date',
    ];
    //hàm kiểm tra hết hạn của mã giảm giá
    public function isExpired()
    {
        return $this->expiry_date < now();
    }
}
