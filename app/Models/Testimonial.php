<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'customer_name',
        'job_title',
        'email',
        'phone',
        'photo',
        'feedback',
        'stars',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'stars' => 'integer',
    ];
}
