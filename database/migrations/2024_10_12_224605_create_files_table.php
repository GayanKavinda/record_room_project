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
