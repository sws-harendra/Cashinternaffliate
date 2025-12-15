<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingSubCategory extends Model
{
    protected $table = 'training_sub_category';
    protected $fillable = ['category_id', 'name', 'slug', 'description', 'banner', 'status'];

    public function category()
    {
        return $this->belongsTo(TrainingCategory::class, 'category_id');
    }

     public function videos()
    {
        return $this->hasMany(TrainingVideo::class, 'sub_category_id')
            ->where('status', 1);
    }
}
