<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ControllerModel extends Model
{
    // Table
    protected $table = 'controllers';

    //Primary Key
    public $primaryKey = 'id';

    // timestamps
    public $timestamps = true;

    public function functions()
    {
        return $this->hasMany('App\Functionary', 'ControllerID');
    }
}
