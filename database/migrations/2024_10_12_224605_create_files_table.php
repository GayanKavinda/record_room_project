<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('file_no')->unique();
            $table->string('responsible_officer');
            $table->date('open_date');
            $table->date('close_date')->nullable();
            $table->bigInteger('department_no')->unsigned(); // or wherever appropriate
            $table->timestamps();
        });

        // Change the charset and collation after the table creation
        DB::statement('ALTER TABLE files CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
        Schema::table('files', function (Blueprint $table) {
            $table->dropColumn('department_no');
        });
    }
};
