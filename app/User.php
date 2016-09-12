<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function messages()
    {
        return Message::where('to', '=', $this->id)
            ->orWhere('broadcast', '=', true)
            ->get();
    }
    
    public function conversations()
    {
        return Message::where('to', '=', $this->id)
            ->orWhere('from', '=', $this->id)
            ->orWhere('broadcast', '=', true)
            ->get();
    }
    
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function watching()
    {
        return $this->belongsToMany(Job::class);
    }

    public function isWatching($job)
    {
        $jobs = $this->watching->map(function ($job) {
            return $job->id;
        });

        return in_array($job->id, $jobs->toArray()) ;
    }

    public function isAdmin()
    {
        if ($this->role == null) {
            return false;
        }
        
        return $this->role->name == 'admin';
    }

    public static function getAdmins()
    {
        return Role::where('name', '=', 'admin')->first()->users;
    }

    public static function findByEmailOrCreate($data)
    {
        $user = self::where('email', '=', $data->getEmail())->first();
        if (!$user) {
            $user = User::create([
                'name' => $data->getName(),
                'email' => $data->getEmail(),
            ]);
        }

        self::checkIfUserNeedsUpdating($data, $user);

        return $user;
    }

    public static function checkIfUserNeedsUpdating($data, $user)
    {
        $socialData = [
            'email' => $data->getEmail(),
            'name' => $data->getName(),
        ];
        $dbData = [
            'email' => $user->email,
            'name' => $user->name,
        ];

        if (!empty(array_diff($socialData, $dbData))) {
            $user->email = $data->getEmail();
            $user->name = $data->getName();
            $user->save();
        }
    }
}
