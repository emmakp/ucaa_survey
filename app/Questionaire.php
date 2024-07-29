<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questionaire extends Model
{

    protected $fillable = ['obfuscator', 'survey_id', 'validity', 'target_audience'];
}
