<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['answer', 'score', 'question_id', 'survey_submission_id'];

    public function question()
    {
        return $this->belongsTo('App\Question', 'question_id');
    }

    public function surveySubmission()
    {
        return $this->belongsTo('App\Models\SurveySubmission', 'survey_submission_id');
    }
}