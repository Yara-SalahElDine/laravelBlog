<?php

namespace App;
use Carbon;

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
    /**
    * Get the user's created_at .
    *
    * @return string
    */
    public function getDateAttribute()
    {
        $createdAt = new Carbon ($this->created_at);
        //dd($createdAt->format('jS \o\f F, Y g:i:s a'));
      return "{$createdAt->format('l jS \\of F Y h:i:s A')}";
    }
}
