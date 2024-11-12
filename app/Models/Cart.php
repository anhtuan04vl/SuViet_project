<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';
    protected $primaryKey = 'cart_id'; // Chỉ định khóa chính nếu là cart_id
    public $incrementing = true; // Đảm bảo khóa chính tăng dần
    public $timestamps = true; // Kích hoạt tự động quản lý timestamp

    protected $fillable = [
        'users_id', 'total_price'
    ];

    public function details()
    {
        return $this->hasMany(CartDetail::class, 'cart_id', 'cart_id');
    }
}
