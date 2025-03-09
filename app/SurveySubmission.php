<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SurveySubmission extends Model
{
    protected $fillable = ['survey_id', 'user_id', 'submitted_at'];

    protected $casts = [
        'submitted_at' => 'datetime', // Ensures Carbon instance
    ];

    public function survey()
    {
        return $this->belongsTo('App\Survey', 'survey_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function answers()
    {
        return $this->hasMany('App\Answer', 'survey_submission_id');
    }
}