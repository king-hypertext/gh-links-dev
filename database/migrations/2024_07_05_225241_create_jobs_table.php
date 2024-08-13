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
        Schema::create('gh_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type');
            $table->integer('min_salary');
            $table->integer('max_salary');
            $table->foreignId('employer_id')->constrained('employers')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('salary_id')->constrained('salaries');
            $table->foreignId('education_id')->constrained('education');
            $table->string('min_experience');
            $table->integer('open_vacancies');
            $table->foreignId('entry_id')->constrained('job_experience');
            $table->foreignId('city_id')->constrained('cities');
            $table->longText('requirements');
            $table->longText('description');
            $table->longText('benefits');
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
