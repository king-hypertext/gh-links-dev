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
        // Schema::create('candidate_resume', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('candidate_profile_id')->constrained('candidate_profile')->cascadeOnDelete()->cascadeOnUpdate();
        //     $table->string('name');
        //     $table->string('file');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidate_resume');
    }
};
