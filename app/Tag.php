<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public $fillable = ['name', 'description'];
    
    public function jobs()
    {
        return $this->belongsToMany(Job::class);
    }
}
