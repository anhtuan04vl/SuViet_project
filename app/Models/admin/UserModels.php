<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserModels extends Model
{
    use HasFactory;
    // Các cột có thể điền được trong bảng users
    protected $table = 'users'; // Tên bảng trong cơ sở dữ liệu
    protected $fillable = ['users_id', 'fullname', 'username', 'email', 'role', 'images', 'creat_at', 'updated_at'];

        public function getImageUrlAttribute()
    {
        return asset('img/' . ($this->images ?? 'default.jpg'));
    }
    
}
