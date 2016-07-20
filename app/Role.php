<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $fillable = ['name'];
    
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
