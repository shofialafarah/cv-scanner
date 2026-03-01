<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = [
        'user_id',
        'job_post_id',
        'name',
        'email',
        'phone',
        'cv_file',
        'skills',
        'score',
        'ai_summary',
        'parsed_data',
        'status'
    ];

    protected $casts = [
        'skills' => 'array',
        'parsed_data' => 'array',
    ];

    public function jobPost()
    {
        return $this->belongsTo(JobPost::class);
    }
}
