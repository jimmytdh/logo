<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    protected $fillable = ['entry_no','name','path'];
    protected $table = 'entry';
}
