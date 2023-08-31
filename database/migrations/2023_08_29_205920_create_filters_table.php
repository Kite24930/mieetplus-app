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
        Schema::create('filters', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('user_id')->unsigned()->unique();
            $table->text('category')->nullable();
            $table->text('location')->nullable();
            $table->text('work_location')->nullable();
            $table->date('establishment_date')->nullable();
            $table->text('establishment_date_type')->nullable();
            $table->integer('capital')->unsigned()->nullable();
            $table->text('capital_type')->nullable();
            $table->integer('sales')->unsigned()->nullable();
            $table->text('sales_type')->nullable();
            $table->integer('employee_number')->unsigned()->nullable();
            $table->text('employee_number_type')->nullable();
            $table->integer('graduated_number')->unsigned()->nullable();
            $table->text('graduated_number_type')->nullable();
            $table->text('faculties')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filters');
    }
};
