<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    protected $fillable = [
        'title',
        'description',
        'deadline',
        'required_skills',
    ];

    protected $casts = [
        'required_skills' => 'array',
        'deadline' => 'date',
    ];
    
    public function candidates()
    {
        return $this->hasMany(Candidate::class, 'job_post_id');
    }
}