<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
     use HasFactory, Notifiable;

    protected $primaryKey = 'user_id';
    
    protected $fillable = [
        'role_id', 'u_name', 'u_email', 'u_pass', 'status'
    ];

    protected $hidden = ['u_pass'];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'user_id');
    }

    public function statusRecords()
    {
        return $this->hasMany(UserStatus::class, 'user_id');
    }

    public function getAuthPassword()
    {
        return $this->u_pass;
    }

    public function setUPassAttribute($value)
    {
        $this->attributes['u_pass'] = Hash::make($value);
    }
}