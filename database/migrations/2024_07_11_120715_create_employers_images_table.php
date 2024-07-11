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
        Schema::create('employer_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employer_profile_id')->constrained('employer_profiles')->cascadeOnDelete()->cascadeOnUpdate();
            $table->text('banner_image')->nullable();
            $table->text('logo_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employers_images');
    }
};
