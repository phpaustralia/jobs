<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
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

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function isAdmin()
    {
        if ($this->role == null) {
            return false;
        }
        
        return $this->role->name == 'admin';
    }

    public static function findByEmailOrCreate($data)
    {
        $user = self::where('email', '=', $data->email)->first();
        if(!$user) {
            $user = User::create([
                'name' => $data->name,
                'email' => $data->email,
            ]);
        }

        self::checkIfUserNeedsUpdating($data, $user);

        return $user;
    }

    public static function checkIfUserNeedsUpdating($data, $user)
    {
        $socialData = [
            'email' => $data->email,
            'name' => $data->name,
        ];
        $dbData = [
            'email' => $user->email,
            'name' => $user->name,
        ];

        if (!empty(array_diff($socialData, $dbData))) {
            $user->email = $data->email;
            $user->name = $data->name;
            $user->save();
        }
    }
}
