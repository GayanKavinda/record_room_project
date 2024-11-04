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
            $table->date('given_date')->nullable()->after('department_no');
            $table->integer('page_capacity')->nullable()->after('given_date');
            $table->text('note')->nullable()->after('page_capacity');
            $table->date('expire_date')->nullable()->after('note');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('files', function (Blueprint $table) {
            $table->dropColumn(['given_date', 'page_capacity', 'note', 'expire_date']);
        });
    }
};
