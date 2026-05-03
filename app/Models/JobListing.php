<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobListing extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'location',
        'salary',
        'job_type',
        'deadline',
        'status',
    ];

    public function employer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}