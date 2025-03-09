<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questionaire extends Model
{

    protected $fillable = ['obfuscator', 'survey_id', 'validity', 'target_audience'];

    public function survey(){
        return $this->belongsTo('App\Survey', 'survey_id');
    }

    public function target_audience_rq(){
        return $this->belongsTo('App\Audience', 'target_audience');
    }

    public function questions(){
        return $this->hasMany('App\Question', 'questionaire_id');
    }
}
