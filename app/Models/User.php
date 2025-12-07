<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'image',
        'phone',
        'address',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Interact with the user's first name.

     *

     * @param  string  $value
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function isAdmin(): bool
    {
        return ($this->attributes['type'] ?? 0) == 1;
    }

    public function isManager(): bool
    {
        return ($this->attributes['type'] ?? 0) == 2;
    }

    public function isUser(): bool
    {
        return ($this->attributes['type'] ?? 0) == 0;
    }

    protected function type(): Attribute
    {
        return new Attribute(
            get: function ($value) {
                // Cast to integer and ensure it's within valid range
                $typeIndex = (int) $value;

                $types = ['user', 'admin', 'manager'];

                return $types[$typeIndex] ?? 'user';
            }
        );
    }
}
