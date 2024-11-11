<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductModel extends Model
{
    use HasFactory;

    // Các cột có thể điền được trong bảng products
    protected $table = 'products'; // Tên bảng trong cơ sở dữ liệu
    protected $primaryKey = 'product_id'; // Đảm bảo bạn chỉ định khóa chính là 'product_id'
    protected $fillable = ['name', 'short_description', 'price', 'category_id', 'img'];
}
