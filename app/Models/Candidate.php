<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = [
        'name',
        'email',
        'cv_file',
        'parsed_data',
        'score',
    ];

    protected $casts = [
    'parsed_data' => 'array',
];
}
