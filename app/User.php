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
        'name', 'email', 'password','headimg'
        ,'phone','company','weibo_id'
        ,'weixin_id','qq_id','confirm_code'
        ,'position','status'

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','weixin_id','weibo_id','qq_id','confirm_code','password'
    ];


    public function projects()
    {
        return $this->hasMany('App\Project');
    }

    public function apis()
    {
        return $this->hasMany('App\Api');
    }
}
