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
        Schema::table('files', function (Blueprint $table) {
            $table->boolean('is_editable')->default(true)->after('note'); // Enable edit button by default
            $table->boolean('is_expirable')->default(false)->after('is_editable'); // Disable expire button by default
        });

        // Change the charset and collation after modifying the table
        DB::statement('ALTER TABLE files CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('files', function (Blueprint $table) {
            $table->dropColumn('is_editable');
            $table->dropColumn('is_expirable');
        });
    }
};
