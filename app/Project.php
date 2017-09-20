<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name', 'description','url','iconimg','status','user_id','qrcode','doc_id','backgdimg',
    ];
    //
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function apis()
    {
        return $this->hasMany('App\Api');
    }

    public function doc()
    {
        return $this->hasOne('App\Doc');

    }

}
