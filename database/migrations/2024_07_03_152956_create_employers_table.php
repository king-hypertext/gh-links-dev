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
            $table->string('username')->unique();
            $table->string('email')->unique();
            // $table->boolean('is_employer')->default(true);
            $table->string('password');
            $table->string('first_name');
            $table->string('last_name');
            // $table->enum('gender', ['male', 'female']);
            $table->string('full_name')->virtualAs("CONCAT(first_name, ' ', last_name)");
            $table->string('phone_number');
            $table->boolean('accept_terms');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
