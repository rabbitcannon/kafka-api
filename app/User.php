<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable =
    [
        'first_name', 'last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function packages()
    {
        return $this->belongsToMany('App\Package');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile() {
        return $this->hasOne('App\Profile');
    }

    /**
     * @param $name
     */
    public function setFirstNameAttribute($name)  {
        $this->attributes['first_name'] = ucwords($name);
    }

    /**
     * @param $name
     */
    public function setLastNameAttribute($name) {
        $this->attributes['last_name'] = ucwords($name);
    }

    /**
     * @param $email
     */
    public function setEmailAttribute($email) {
        $this->attributes['email'] = strtolower($email);
    }
}
