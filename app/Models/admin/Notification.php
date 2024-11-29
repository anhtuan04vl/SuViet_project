<?php

namespace App\Models\admin;
use App\Models\Order;
use App\Models\admin\UserModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Notification extends Model
{
    use HasFactory;
    // Chỉ định các cột có thể gán giá trị hàng loạt
    protected $table = 'notifications';
    protected $fillable = ['id', 'order_id_noti', 'message', 'user_id_noti', 'role', 'status', 'creat_at', 'updated_at'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id_noti');
    }

    public function user()
    {
        return $this->belongsTo(UserModels::class, 'user_id_noti');
    }
}
