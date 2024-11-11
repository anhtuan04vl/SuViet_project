<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class UserModels extends Model
{
    use HasFactory;
    // Các cột có thể điền được trong bảng users
    protected $table = 'users'; // Tên bảng trong cơ sở dữ liệu
    protected $fillable = ['users_id', 'fullname', 'username', 'email', 'role', 'images', 'creat_at', 'updated_at'];
}
