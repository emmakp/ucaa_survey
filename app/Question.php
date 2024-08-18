<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //

    public function options(){
        return $this->hasMany('App\Option', 'question_id');
    }

    public function questionaire(){
        return $this->belongsTo('App\Questionaire', 'questionaire_id');
    }
}
