<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRoles extends Model
{
    //Table name
    protected $table = 'userroles';

    // Primary Key;
    public $primaryKey = 'id';

    // timestamps
    public $timestamps = true;

    // Users table relationship
    public function user(){
        return $this->belongsTo('App\User', 'created_by');
    }
}
