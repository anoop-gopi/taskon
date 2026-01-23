<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskCompleted extends Model
{
    use HasFactory;

    protected $table = 'tasks_completed';

    protected $fillable = [
        'task_id',
        'user_id',
        'image_path',
        'notes',
        'date_time',
        'status',
    ];

    protected $casts = [
        'date_time' => 'datetime',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function taskStatus()
    {
        return $this->belongsTo(TaskStatus::class, 'status');
    }
}
