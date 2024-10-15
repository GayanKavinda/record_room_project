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
        // Drop the users table if it exists to recreate it with new structure
        Schema::dropIfExists('users');

        // Create a new users table with the new structure
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id')->unique(); // Change to string
            $table->string('name');
            $table->string('department_name');
            $table->string('join_or_transfer'); // Field to determine if it's a Join or Transfer
            $table->date('date')->nullable(); // Date field
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });

        // Note: You may want to set up additional relationships or indexes here if needed
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
