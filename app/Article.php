<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',

        'user_id',
        'organization_id',
        
        'journal_id',
    ];
}
