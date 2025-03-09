<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Functionary extends Model
{
    // Table
    protected $table = 'functionary';

    //Primary Key
    public $primaryKey = 'id';

    // timestamps
    public $timestamps = true;

    public function contoller()
    {
        return $this->belongsTo('App\ControllerModel', 'ControllerID');
    }

    public function user_function()
    {
        return $this->belongsTo('App\UserRoleFunctionary', 'Function');
    }
}
