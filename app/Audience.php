<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Audience extends Model
{
    // Table
    protected $table = 'audiences';

    //Primary Key
    public $primaryKey = 'id';

    // timestamps
    public $timestamps = true;

    // hidden attributes
    protected $hidden = [

    ];
    protected $fillable =['title', 'created_by', 'obfuscator', 'validity'];

    // public function surveys()
    // {
    //     return $this->hasMany(Survey::class, 'audience_id');
    // }
    public function surveys()
    {
        return $this->belongsToMany(Survey::class, 'audience_survey', 'audience_id', 'survey_id')
                    ->withTimestamps();
    }

    public function user(){
        return $this->belongsTo('App\User', 'created_by');

    }

    public function getDisplayNameAttribute()
    {
        return ucwords(str_replace('_', ' ', $this->name));
    }
}
