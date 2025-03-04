<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class QuestionType extends Model
{
    protected $fillable = ['type', 'obfuscator'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->obfuscator)) {
                // Keep generating a random string until it’s unique
                do {
                    $obfuscator = Str::random(10);
                } while (static::where('obfuscator', $obfuscator)->exists());
                $model->obfuscator = $obfuscator;
            }
        });
    }
}