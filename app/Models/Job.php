<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
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
        return $this->hasMany(Candidate::class);
    }
}
