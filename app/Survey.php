<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Survey extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'status', 'obfuscator', 'created_by', 'published'];

    public function user(){
        return $this->belongsTo('App\User', 'created_by');
    }

    public function questionaires(){
        return $this->hasMany('App\Questionaire', 'survey_id');
    }

    public function questions()
    {
        return $this->hasMany('App\Question', 'survey_id');
    }
}

