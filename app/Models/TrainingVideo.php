<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingVideo extends Model
{
    protected $table = 'training_videos';
    protected $fillable = ['sub_category_id', 'title', 'description', 'video_url', 'duration', 'status'];

    public function subCategory()
    {
        return $this->belongsTo(TrainingSubCategory::class, 'sub_category_id');
    }

    
}
