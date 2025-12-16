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
        'admin_remark',
        'verified_at',
    ];

    protected $casts = [
        'verified_at' => 'datetime',
    ];

    public function recruiter()
    {
        return $this->belongsTo(Recruiter::class);
    }
}
