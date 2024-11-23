<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    // Định nghĩa bảng tương ứng trong cơ sở dữ liệu
    protected $table = 'withlists'; // Tên bảng trong cơ sở dữ liệu

    // Các trường có thể gán giá trị đại diện cho cột của bảng
    protected $fillable = [
        'user_id', // Cột chứa user_id
        'product_id', // Cột chứa product_id
    ];

    // Nếu bạn có mối quan hệ giữa các bảng, bạn có thể định nghĩa mối quan hệ ở đây
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id'); // product_id trong bảng withlists là khóa ngoại
    }
    

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}