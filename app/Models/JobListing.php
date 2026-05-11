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
        'salary_min',
        'salary_max',
        'salary_currency',
        'salary_type',
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

    public function applications()
    {
        return $this->hasMany(Application::class, 'job_id');
    }

    public function getSalaryDisplayAttribute()
    {
        if ($this->salary_type === 'negotiable') {
            return 'Negotiable';
        }

        if ($this->salary_type === 'fixed') {
            return $this->salary_currency . ' ' . number_format($this->salary_min, 0);
        }

        if ($this->salary_type === 'range') {
            return $this->salary_currency . ' ' . number_format($this->salary_min, 0) .
                   ' - ' . number_format($this->salary_max, 0);
        }

        return 'Not specified';
    }
}