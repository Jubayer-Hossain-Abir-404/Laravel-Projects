<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'employee_id',
        'name',
        'email',
        'company',
        'city',
        'country',
        'dob',
    ];
}
