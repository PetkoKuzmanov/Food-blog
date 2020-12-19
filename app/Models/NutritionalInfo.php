<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NutritionalInfo extends Model
{
    use HasFactory;

    protected $fillable = ['servingSize', 'calories'];

    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }
}
