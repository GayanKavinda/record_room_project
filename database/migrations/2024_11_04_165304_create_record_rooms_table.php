<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordRoomsTable extends Migration
{
    public function up()
    {
        Schema::create('record_rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('file_id')->constrained('files');
            $table->string('rack_letter');
            $table->integer('sub_rack');
            $table->integer('cell_number');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('record_rooms');
    }
}
