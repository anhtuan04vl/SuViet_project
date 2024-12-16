<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blogs';
    // Cho phép mass assignment cho các trường này
    protected $fillable = [
        'title', 
        'description', 
        'category_id', 
        'users_id', 
        'images', 
        'is_active'
    ];

    // Định nghĩa quan hệ với bảng Categories
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Định nghĩa quan hệ với bảng Products
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Định nghĩa quan hệ với bảng Users
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
