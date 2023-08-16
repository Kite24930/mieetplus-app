<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'ruby',
        'category',
        'url',
        'job_description_tellers',
        'tellers_img_1',
        'job_description',
        'culture_tellers',
        'tellers_img_2',
        'culture',
        'environment_tellers',
        'tellers_img_3',
        'environment',
        'feature',
        'career_path',
        'desired_person',
        'transfer',
        'content',
        'pr',
        'notice',
        'location',
        'location_lat',
        'location_lng',
        'work_location',
        'establishment_date',
        'capital',
        'sales',
        'employee_number',
        'graduated_number',
        'faculties',
        'occupations',
        'recruit_name',
        'recruit_ruby',
        'recruit_email',
        'top_img',
        'movie',
        'logo',
        'mail_permission',
    ];
}
