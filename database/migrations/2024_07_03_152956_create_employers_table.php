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
        Schema::create('employers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('company_name')->unique('company')->index('company_name');
            $table->longText('company_description');
            $table->foreignId('organization_id')->constrained('organizations');
            $table->foreignId('industry_id')->constrained('industries');
            $table->string('company_size');
            $table->string('company_website');
            $table->date('company_founding_year');
            $table->longText('company_vision');
            $table->text('company_location');
            $table->string('company_email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employers');
    }
};
