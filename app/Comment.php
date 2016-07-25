<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $fillable = ['body', 'user_id', 'job_id'];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
