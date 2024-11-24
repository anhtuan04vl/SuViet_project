<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

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
    /**
     * Update the fullname of the user.
     *
     * @param string $fullname
     * @return bool
     */
    public function updateFullname(string $fullname): bool
    {
        $this->fullname = $fullname;
        return $this->save();
    }

    /**
     * Update the username of the user.
     *
     * @param string $username
     * @return bool
     */
    public function updateUsername(string $username): bool
    {
        $this->username = $username;
        return $this->save();
    }

    /**
     * Update the email of the user.
     *
     * @param string $email
     * @return bool
     */
    public function updateEmail(string $email): bool
    {
        $this->email = $email;
        return $this->save();
    }

    /**
     * Update the password of the user.
     *
     * @param string $password
     * @return bool
     */
    public function updatePassword(string $password): bool
    {
        $this->password = bcrypt($password);
        return $this->save();
    }

    /**
     * Update the profile image of the user.
     *
     * @param string $imagePath
     * @return bool
     */
    public function updateImage(string $imagePath): bool
    {
        $this->images = $imagePath;
        return $this->save();
    }
    public function updateUserInfo($data)
    {
        $this->update($data); // Sử dụng Eloquent để cập nhật dữ liệu
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
}
