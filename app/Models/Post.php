<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title','content'];

    public function images()
    {
        return $this->morphMany('App\Models\Image', 'image');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }

    public function user() 
    {
        return $this->belongsTo('App\Models\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function nutritionalInfo()
    {
        return $this->hasOne('App\Models\NutritionalInfo');
    }
}
