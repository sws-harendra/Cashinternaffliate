<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingCategory extends Model
{
    protected $table = 'training_category';
    protected $fillable = ['name'];

      public function subcategories()
    {
        return $this->hasMany(TrainingSubCategory::class, 'category_id');
    }
}
