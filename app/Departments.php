<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
    //
    // protected $fillable = ['name', 'is_active'];

    protected $fillable = ['Name', 'Description', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    //Table name
    protected $table = 'departments';

    // Primary Key;
    public $primaryKey = 'id';

    // timestamps
    public $timestamps = true;

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    
}
