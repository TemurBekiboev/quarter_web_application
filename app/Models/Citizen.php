<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Citizen extends Authenticatable
{
    use HasFactory;

    protected $guard = 'citizens';

    protected $fillable = [
        'street_id',
        'home_number',
        'contact',
        'location',
        'regsitered',
        'login_id',
        'password'
    ];
}
