<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Api extends Model
{
    protected $fillable = [
        'url','type', 'description','method','json','json_data','json_description','status','baseurl','param','param_description','project_id','user_id','version','url_method',
    ];
    //
    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
