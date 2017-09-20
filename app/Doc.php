<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doc extends Model
{
    //
    protected $fillable = [
        'doc_title', 'doc_description','doc_baseurl','doc_version','doc_backgdimg','doc_passwd','project_id',
    ];
}
