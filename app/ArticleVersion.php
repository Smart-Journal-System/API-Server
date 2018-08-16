<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleVersion extends Model
{
    use HasUUID;

    public $incrementing = false;

    public function article()
    {
        return $this->belongsTo('App\Article');
    }
}
