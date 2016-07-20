<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Job extends Model
{
    public $fillable = ['name', 'description', 'user_id'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approve()
    {
        if (Gate::denies('approve', $this)) {
            abort(403);
        }
        
        $this->approved = true;
    }
}
