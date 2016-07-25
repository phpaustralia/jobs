<?php

namespace App;

use App\Models\Collections\MessageCollection;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['to', 'title', 'body'];
    
    public function sender()
    {
        return $this->belongsTo(User::class, 'from');
    }
    
    public function receiver()
    {
        return $this->belongsTo(User::class, 'to');
    }

    /**
     * Create a new Eloquent Collection instance.
     *
     * @param  array  $models
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function newCollection(array $models = [])
    {
        return new MessageCollection($models);
    }
}
