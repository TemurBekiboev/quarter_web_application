<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class quarterfile extends Model
{
    use HasFactory;
    protected $fillable = [
        'street_id',
        'file'
    ];
}
