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
        Schema::create('candidate_profile', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidate_id')->constrained('candidates')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('full_name')->virtualAs('CONCAT(first_name, " ", last_name)');
            $table->enum('gender', ['male', 'female']);
            $table->string('website_url')->nullable();
            $table->enum('marital_status', ['single', 'married', 'divorced']);
            $table->string('nationality')->default('ghanaian');
            $table->date('date_of_birth');
            $table->string('experience');
            $table->string('profile_picture');
            $table->longText('biography')->nullable();
            // $table->string('cv')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidate_profile');
    }
};
