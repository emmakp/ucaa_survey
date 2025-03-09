<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuditTrail extends Model
{
    protected $table = 'audit_trail';
    public $primaryKey = 'id';
    public $timestamps = true;

    // Updated $fillable array to include all fields
    protected $fillable = ['user_id', 'controller', 'function', 'action', 'date'];
    // protected $fillable = ['user_id', 'controller', 'action'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}