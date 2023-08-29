<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'univ_email',
        'faculty',
        'glade',
        'screen_name',
        'img',
        'name_type',
        'notice',
        'history',
    ];
}
