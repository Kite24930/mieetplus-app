<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('user_id')->unsigned();
            $table->text('name');
            $table->text('ruby');
            $table->text('category');
            $table->text('url')->nullable()->default(null);
            $table->mediumText('job_description_tellers');
            $table->text('tellers_img_1')->nullable()->default(null);
            $table->mediumText('job_description')->nullable()->default(null);
            $table->mediumText('culture_tellers');
            $table->text('tellers_img_2')->nullable()->default(null);
            $table->mediumText('culture')->nullable()->default(null);
            $table->mediumText('environment_tellers');
            $table->text('tellers_img_3')->nullable()->default(null);
            $table->mediumText('environment')->nullable()->default(null);
            $table->mediumText('feature');
            $table->mediumText('career_path');
            $table->mediumText('desired_person');
            $table->mediumText('transfer')->nullable()->default(null);
            $table->mediumText('content');
            $table->mediumText('pr')->nullable()->default(null);
            $table->mediumText('notice')->nullable()->default(null);
            $table->text('location');
            $table->double('location_lat');
            $table->double('location_lng');
            $table->text('work_location');
            $table->date('establishment_date');
            $table->integer('capital');
            $table->integer('sales')->nullable()->default(null);
            $table->integer('employee_number');
            $table->integer('graduated_number')->nullable()->default(null);
            $table->text('faculties')->nullable()->default(null);
            $table->text('occupations')->nullable()->default(null);
            $table->text('recruit_name')->nullable()->default(null);
            $table->text('recruit_ruby')->nullable()->default(null);
            $table->text('recruit_email')->nullable()->default(null);
            $table->text('top_img');
            $table->text('movie')->nullable()->default(null);
            $table->text('logo')->nullable()->default(null);
            $table->tinyInteger('mail_permission')->default(0);
            $table->tinyInteger('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
