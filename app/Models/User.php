<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use App\Models\admin\Notification;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'users_id';
    protected $fillable = [
        'fullname',
        'username',
        'email',
        'password',
        'images',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if (empty($user->images)) {
                $user->images = 'avata.png';
            }

            if (empty($user->remember_token)) {
                $user->remember_token = Str::random(10);
            }
        });
    }
    // Thiết lập quan hệ với model Contact
    public function contacts()
    {
        return $this->hasMany(Contact::class, 'users_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'users_id');
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class, 'user_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_id_noti');
    }
}
