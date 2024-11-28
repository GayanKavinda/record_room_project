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
            $table->string('status')->default('Active')->after('is_expirable');
            $table->string('rack_letter')->nullable()->after('status');
            $table->integer('sub_rack')->nullable()->after('rack_letter');
            $table->integer('cell_number')->nullable()->after('sub_rack');
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
            $table->dropColumn(['status', 'rack_letter', 'sub_rack', 'cell_number']);
        });
    }
};
