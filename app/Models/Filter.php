<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category',
        'location',
        'work_location',
        'establishment_date',
        'establishment_date_type',
        'capital',
        'capital_type',
        'sales',
        'sales_type',
        'employee_number',
        'employee_number_type',
        'graduated_number',
        'graduated_number_type',
        'faculties',
    ];
}
