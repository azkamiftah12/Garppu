<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateC1Table extends Migration
{
    public function up()
    {
        Schema::create('c1', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 255);
            $table->foreign('nik')->references('nik')->on('userprofile');
            $table->string('img_c1', 255);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('c1');
    }
}
