<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobRole extends Model
{
     protected $fillable = ['name', 'job_category_id', 'is_active'];

    public function category()
    {
        return $this->belongsTo(JobCategory::class, 'job_category_id');
    }
}
