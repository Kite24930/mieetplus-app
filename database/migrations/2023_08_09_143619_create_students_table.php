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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('user_id')->unsigned();
            $table->text('univ_email')->nullable();
            $table->tinyInteger('sex', 2);
            $table->date('birthday');
            $table->text('faculty');
            $table->integer('glade');
            $table->text('screen_name')->nullable();
            $table->text('img')->nullable();
            $table->tinyInteger('name_type')->default(0);
            $table->tinyInteger('notice')->default(0);
            $table->tinyInteger('history')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
