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
        Schema::create('candidate_job_experience', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidate_profile_id')->constrained('candidate_profile')->cascadeOnDelete()->cascadeOnUpdate();
            $table->boolean('is_current')->default(0);
            $table->date('started_at')->nullable();
            $table->date('ended_at')->nullable();
            $table->string('position')->nullable();
            $table->text('job_description')->nullable();
            $table->string('company_name')->nullable();
            $table->string('location')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_experience');
    }
};
