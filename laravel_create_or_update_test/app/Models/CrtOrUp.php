<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrtOrUp extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'unique_key',
    ];
}
