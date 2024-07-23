<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class street extends Model
{
    use HasFactory;

    protected $fillable = [
        'quarter_id',
        'name',
    ];

    public $timestamps = false;
}
