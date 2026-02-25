<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = [
        'job_id',
        'name',
        'email',
        'phone',
        'cv_file',
        'skills',
        'score',
        'ai_summary',
        'parsed_data',
    ];

    protected $casts = [
        'skills' => 'array',
        'parsed_data' => 'array',
    ];

    public function job()
{
    return $this->belongsTo(Job::class);
}
}
