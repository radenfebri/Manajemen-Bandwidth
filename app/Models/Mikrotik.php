<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mikrotik extends Model
{
    use HasFactory;

    protected $table = 'mikrotiks';

    protected $fillable = [
        'ip',
        'user',
        'password',
    ];
}
