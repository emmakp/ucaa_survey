<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;

    //Table name
    protected $table = 'employees';

    // Primary Key;
    public $primaryKey = 'id';

    // timestamps
    public $timestamps = true;

    public function department()
    {
        return $this->belongsTo('App\Departments', 'DepartmentID');   
    }

    public function user_title()
    {
        return $this->belongsTo('App\Titles', 'TitleID');   
    }
}
