<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    protected $table = 'job_posts';
    
     protected $fillable = [
        'recruiter_id',
        'job_category_id',
        'job_role_id',
        'job_type_id',
        'job_location_id',
        'experience_level_id',
        'salary_range_id',
        'title',
        'slug',
        'description',
        'responsibilities',
        'skills',
        'status',
        'is_active',
        'approved_at',
        'approved_by',
    ];

    protected static function booted()
    {
        static::creating(function ($job) {
            $job->slug = Str::slug($job->title) . '-' . uniqid();
        });
    }

    /* ================= RELATIONS ================= */

    public function recruiter() {
        return $this->belongsTo(Recruiter::class);
    }

    public function category() {
        return $this->belongsTo(JobCategory::class, 'job_category_id');
    }

    public function role() {
        return $this->belongsTo(JobRole::class, 'job_role_id');
    }

    public function type() {
        return $this->belongsTo(JobType::class, 'job_type_id');
    }

    public function location() {
        return $this->belongsTo(JobLocation::class, 'job_location_id');
    }

    public function experience() {
        return $this->belongsTo(ExperienceLevel::class, 'experience_level_id');
    }

    public function salary() {
        return $this->belongsTo(SalaryRange::class, 'salary_range_id');
    }
}
