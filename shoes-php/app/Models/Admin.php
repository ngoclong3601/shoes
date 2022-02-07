<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\Admin as Authenticatable;

class Admin extends Authenticatable{
    use Notifiable;

    protected $fillable = [
        'name', 
        'email', 
        'password',
        'phone',
        'address'
    ];
    protected $hidden = [
        'password', 
        'remember_token',
    ];
}
