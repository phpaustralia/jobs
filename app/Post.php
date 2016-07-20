<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $fillable = ['name', 'content', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
