<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts';

    protected $primaryKey = 'contact_id';

    protected $fillable = [
        'users_id',
        'phone',
        'email',
        'address',
        'district',
        'city',
        'is_default',
    ];

    // Thiết lập mối quan hệ với model User
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    /**
     * Phương thức này giúp lấy thông tin liên hệ mặc định của người dùng.
     */
    public function scopeDefault($query)
    {
        return $query->where('is_default', true);
    }
}
