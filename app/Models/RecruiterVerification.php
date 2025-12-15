<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecruiterVerification extends Model
{
     protected $fillable = [
        'recruiter_id',
        'document_type',
        'document_file',
        'status',
        'admin_remark'
    ];

    public function recruiter()
    {
        return $this->belongsTo(Recruiter::class);
    }
}
