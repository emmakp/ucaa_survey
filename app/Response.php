<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $fillable = ['survey_id', 'question_id', 'answer', 'audience_type', 'submitted_at', 'response'];

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}