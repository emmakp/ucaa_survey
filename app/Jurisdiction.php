<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jurisdiction extends Model
{
    protected $fillable = ['name', 'is_active'];

    // Optional: Scope for active jurisdictions
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}