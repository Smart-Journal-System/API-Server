<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasUUID;

    public $incrementing = false;

    protected $fillable = [
        'name'
    ];

    public function users()
    {
        return $this->belongsToMany('App\User', 'organization_users');
    }
}
