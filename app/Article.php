<?php

namespace App;

use App\HasUUID;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasUUID;

    public $incrementing = false;

    protected $fillable = [
        'title',

        'user_id',
        'organization_id',

        'journal_id',
    ];
}
