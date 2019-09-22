<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class CmsPlugin extends Model
{
    protected $fillable = [
        'vendor',
        'package',
        'short_name',
        'class_name',
    ];
}
