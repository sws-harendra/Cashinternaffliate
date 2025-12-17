<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobCategory extends Model
{
    protected $fillable = ['name', 'is_active'];

    public function roles()
    {
        return $this->hasMany(JobRole::class);
    }
}
