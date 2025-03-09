<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRoleFunctionary extends Model
{
    // Table
    protected $table = 'user_role_functionaries';

    //Primary Key
    public $primaryKey = 'id';

    // timestamps
    public $timestamps = true;

    public function functions()
    {
        return $this->hasMany('App\Functionary', 'Function');
    }

}
