<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'survey_id',
        'audience_type',
        'question',
        'questionaire_id',
        'department',
        'is_required',
        'question_type', // Foreign key to question_types.id
        'obfuscator',
        'validity',
    ];

    public function options()
    {
        return $this->hasMany('App\Option', 'question_id');
    }

    public function questionaire()
    {
        return $this->belongsTo('App\Questionaire', 'questionaire_id');
    }

    public function survey()
    {
        return $this->belongsTo('App\Survey', 'survey_id'); // Corrected namespace
    }

    public function questionType()
    {
        return $this->belongsTo('App\QuestionType', 'question_type'); // Added relationship
    }
}