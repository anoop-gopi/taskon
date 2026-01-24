<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UpgradeRequest extends Model
{
    protected $fillable = [
        'user_id',
        'from_category_id',
        'to_category_id',
        'amount',
        'payment_url',
        'payment_screenshot',
        'status',
        'admin_notes',
        'expires_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'expires_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function fromCategory(): BelongsTo
    {
        return $this->belongsTo(UserCategory::class, 'from_category_id');
    }

    public function toCategory(): BelongsTo
    {
        return $this->belongsTo(UserCategory::class, 'to_category_id');
    }
}
