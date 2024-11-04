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
