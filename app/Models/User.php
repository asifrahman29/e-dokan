<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'role',
        'phone',
        'image',
        'provider',
        'provider_id',
        'avatar',
        'email_verified_at',
    ];

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
     * # Relationships
     * has many : orders, cartitems, wishlists, reviews, payments
     */
    public function orders() : HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function cartItems() : HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function wishlists() : HasMany
    {
        return $this->hasMany(Wishlist::class);
    }

    public function reviews() : HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function payments() : HasMany
    {
        return $this->hasMany(Payment::class);
    }
    /**
     * end of relationships
     */

     /**
      * hasRole
      */

    public function hasRole(string $role) : bool
    {
        return $this->role === $role;
    }
    public function hasAnyRole(array $roles): bool
    {
        return in_array($this->role, $roles);
    }
}
