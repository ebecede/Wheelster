<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    protected $fillable = ['name', 'phoneNumber', 'email', 'address', 'gender', 'DOB', 'role', 'password'];

    // Automatically hash the password before saving it
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    // Hide the password and remember_token when serializing
    protected $hidden = ['password', 'remember_token'];
}

