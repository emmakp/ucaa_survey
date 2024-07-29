<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Audience extends Model
{
    // Table
    protected $table = 'audiences';

    //Primary Key
    public $primaryKey = 'id';

    // timestamps
    public $timestamps = true;

    // hidden attributes
    protected $hidden = [

    ];
}
