<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Syslog extends Model
{
    //
    protected $fillable = [
        'description', 'type', 'level','project_id','user_id'
    ];
}
