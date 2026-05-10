<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'company_name',
        'email',
        'password',
        'google_id',
        'facebook_id',
        'status_id',
        'category_id',
        'crypto_wallet',
        'phone',
        'alternative_email',
        'address',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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

    public function earnings(): HasMany
    {
        return $this->hasMany(UserEarning::class);
    }

    public function withdrawalRequests(): HasMany
    {
        return $this->hasMany(WithdrawalRequest::class);
    }

    public function userStatus(): BelongsTo
    {
        return $this->belongsTo(UserStatus::class, 'status_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(UserCategory::class, 'category_id');
    }

    public function mockTestAttempts(): HasMany
    {
        return $this->hasMany(MockTestAttempt::class);
    }
}
