<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubRelawansTable extends Migration
{
    public function up()
    {
        Schema::create('sub_relawans', function (Blueprint $table) {
            $table->string('nikSubRelawan')->unique();
            $table->string('name');
            $table->string('nik'); // Foreign key referencing the 'nik' column in 'userprofile' table
            $table->foreign('nik')->references('nik')->on('userprofile');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sub_relawans');
    }
}


