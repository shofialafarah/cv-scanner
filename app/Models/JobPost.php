<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    protected $fillable = [
        'title',
        'description',
        'required_skills',
    ];

    protected $casts = [
        'required_skills' => 'array',
    ];
    
    public function candidates()
    {
        return $this->hasMany(Candidate::class, 'job_post_id');
    }
}