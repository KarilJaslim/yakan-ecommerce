<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $role
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'provider',
        'provider_id',
        'provider_token',
        'avatar',
        'email_verified_at',
        'role', // <-- Add this if you want to check admin/user
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'provider_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Check if user registered via OAuth
     */
    public function isOAuthUser(): bool
    {
        return !empty($this->provider);
    }

    /**
     * Get user's display avatar
     */
    public function getAvatarUrlAttribute(): string
    {
        if ($this->avatar) {
            return $this->avatar;
        }

        return 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($this->email))) . '?d=mp&s=200';
    }

    /**
     * User orders (optional, helpful)
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
