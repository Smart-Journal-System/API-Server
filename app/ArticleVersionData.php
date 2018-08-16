<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleVersionData extends Model
{
    public $timestamps = false;
    public $table = 'article_version_data';
    
    public function articleVersion()
    {
        return $this->belongsTo('App\ArticleVersion');
    }
}
