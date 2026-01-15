<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;



class Executive extends Authenticatable
{
    use HasFactory;

    protected $guard = 'manager';

    protected $fillable = [
        'name',
        'email',
        'password',
        'contact_number',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];
}
