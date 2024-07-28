<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileUpload extends Model
{
    //Table name
    protected $table = 'file_uploads';

    // Primary Key;
    public $primaryKey = 'id';

    // timestamps
    public $timestamps = true;
}
