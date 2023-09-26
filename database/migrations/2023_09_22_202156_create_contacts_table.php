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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('types', 12);
            $table->text('corporate_name')->nullable();
            $table->text('corporate_hp')->nullable();
            $table->text('corporate_parson')->nullable();
            $table->text('corporate_ruby')->nullable();
            $table->text('individual_name')->nullable();
            $table->text('individual_ruby')->nullable();
            $table->text('address');
            $table->text('tel')->nullable();
            $table->text('email');
            $table->text('contents');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
