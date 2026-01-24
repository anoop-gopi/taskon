<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserCategory extends Model
{
    protected $fillable = [
        'name',
        'tasks_per_week',
        'earning_per_task',
        'price',
    ];

    protected $casts = [
        'earning_per_task' => 'decimal:2',
        'price' => 'decimal:2',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'category_id');
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'category_id');
    }
}
