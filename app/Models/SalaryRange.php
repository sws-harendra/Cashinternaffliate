<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalaryRange extends Model
{
    protected $table = 'salary_ranges';
    protected $fillable = ['label','min_salary',
        'max_salary',
        'is_active',];


}
