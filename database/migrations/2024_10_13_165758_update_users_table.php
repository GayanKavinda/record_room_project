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
        Schema::table('users', function (Blueprint $table) {
            // Only add columns if they don't already exist
            if (!Schema::hasColumn('users', 'employee_id')) {
                $table->string('employee_id')->unique()->after('id'); // Ensure it's a string
            }

            if (!Schema::hasColumn('users', 'department_name')) {
                $table->string('department_name')->after('employee_id');
            }

            if (!Schema::hasColumn('users', 'join_or_transfer')) {
                $table->string('join_or_transfer')->after('department_name'); // Change jt_date to join_or_transfer
            }

            if (!Schema::hasColumn('users', 'date')) {
                $table->date('date')->after('join_or_transfer'); // Update date column
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'employee_id')) {
                $table->dropColumn('employee_id');
            }
            if (Schema::hasColumn('users', 'department_name')) {
                $table->dropColumn('department_name');
            }
            if (Schema::hasColumn('users', 'join_or_transfer')) {
                $table->dropColumn('join_or_transfer');
            }
            if (Schema::hasColumn('users', 'date')) {
                $table->dropColumn('date');
            }
        });
    }
};
