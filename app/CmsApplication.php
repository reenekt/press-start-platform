<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsApplication extends Model
{
    protected $fillable = [
        'name',
        'url',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
