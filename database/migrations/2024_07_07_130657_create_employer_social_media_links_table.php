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
        Schema::create('employer_social_media_links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employer_id')->constrained('employers')->cascadeOnDelete()->cascadeOnUpdate();
            $table->text('fb')->nullable();
            $table->text('x')->nullable();
            $table->text('instagram')->nullable();
            $table->text('whatsapp')->nullable();
            $table->text('linkedin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_social_media_links');
    }
};
