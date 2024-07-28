<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

// class User extends Authenticatable implements MustVerifyEmail
class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'FirstName', 'SecondName', 'email', 'PhoneNumber', 'password', 'UserRole', 'Obfuscator', 'validity', 'username', 'gender', 'title'
    ];

    public $primaryKey = 'id';
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user_role()
    {
        return $this->belongsTo('App\UserRoles', 'UserRole');   
    }
    
    public function user_title()
    {
        return $this->belongsTo('App\Titles', 'title');   
    }

    public function sale()
    {
        return $this->belongsTo('App\Sales', 'PrescriptionID', 'Obfuscator');
    }

    public function pic()
    {
        return $this->belongsTo('App\FileUpload', 'Obfuscator', 'UID')->where('Type', 'user');
    }
}
