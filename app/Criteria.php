<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    protected $table = 'criteria';
    protected $fillable = [
        'user_id',
        'entry_id',
        'concept',
        'relevance',
        'originality',
        'creativity',
        'impact',
        'total'
    ];
}
