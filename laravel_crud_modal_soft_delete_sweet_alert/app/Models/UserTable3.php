<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTable3 extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'image',
    ];
}
