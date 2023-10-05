<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('CREATE VIEW follower_lists AS SELECT x.id AS id, x.created_at as created_at, x.student_id as student_id, y.name as name, y.email as student_email, y.univ_email as univ_email, y.faculty as faculty, y.grade as grade, y.screen_name as screen_name, x.company_id as company_id, z.name as company_name, z.ruby as company_ruby, z.category as category, z.url as url, z.job_description_tellers as job_description_tellers, z.tellers_img_1 as tellers_img_1, z.job_description as job_description, z.culture_tellers as culture_tellers, z.tellers_img_2 as tellers_img_2, z.culture as culture, z.environment_tellers as environment_tellers, z.tellers_img_3 as tellers_img_3, z.environment as environment, z.feature as feature, z.career_path as career_path, z.desired_person as desired_person, z.transfer as transfer, z.content as content, z.pr as pr, z.notice as notice, z.location as location, z.location_lat as location_lat, z.location_lng as location_lng, z.work_location as work_location, z.establishment_date as establishment_date, z.capital as capital, z.employee_number as employee_number, z.graduated_number as graduated_number, z.faculties as faculties, z.occupations as occupations, z.recruit_name as recruit_name, z.recruit_ruby as recruit_ruby, z.recruit_email as recruit_email, z.top_img as top_img, z.movie as movie, z.logo as logo from followers as x left join student_lists as y on x.student_id = y.user_id left join companies as z on x.company_id = z.id;');
    }
};
