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
        DB::statement('CREATE VIEW student_lists AS SELECT x.id AS id, x.user_id AS user_id, y.name AS name, y.email AS email, x.univ_email AS univ_email, x.faculty AS faculty, x.glade AS glade, x.screen_name AS screen_name, x.img AS img, x.name_type AS name_type, x.notice AS notice, x.history AS history, x.created_at as created_at FROM students AS x LEFT JOIN users AS y ON x.user_id = y.id;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_lists');
    }
};
