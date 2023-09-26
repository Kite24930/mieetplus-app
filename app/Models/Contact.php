<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'types',
        'corporate_name',
        'corporate_hp',
        'corporate_parson',
        'corporate_ruby',
        'individual_name',
        'individual_ruby',
        'address',
        'tel',
        'email',
        'contents',
    ];
}
