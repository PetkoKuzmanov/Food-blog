<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NutritionalInfo extends Model
{
    use HasFactory;

    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }
}