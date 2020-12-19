<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['url'];

    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }

    public function imageable()
    {
        return $this->morphTo();
    }
}
