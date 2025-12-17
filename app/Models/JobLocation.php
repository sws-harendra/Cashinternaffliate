<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobLocation extends Model
{
    protected $table = 'job_locations';
    protected $fillable = ['city', 'state', 'country', 'is_active'];
}
