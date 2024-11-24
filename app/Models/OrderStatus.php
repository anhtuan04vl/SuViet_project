<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $table = 'order_statuses';
    protected $primaryKey = 'order_status_id';
    protected $fillable = ['name'];

    public function orders()
{
    return $this->hasMany(Order::class);
}

}

