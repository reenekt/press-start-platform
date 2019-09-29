<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsPlugin extends Model
{
    protected $fillable = [
        'vendor',
        'package',
        'version',
    ];
}
