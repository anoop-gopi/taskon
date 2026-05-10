<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MockTestAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'mock_test_id',
        'user_id',
        'score',
        'total_questions',
        'completed_at',
    ];

    protected $casts = [
        'score' => 'integer',
        'total_questions' => 'integer',
        'completed_at' => 'datetime',
    ];

    public function mockTest(): BelongsTo
    {
        return $this->belongsTo(MockTest::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

