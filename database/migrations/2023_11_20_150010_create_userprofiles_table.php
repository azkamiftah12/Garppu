<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserprofilesTable extends Migration
{
    public function up()
    {
        Schema::create('userprofile', function (Blueprint $table) {
            $table->string('nik', 40)->primary();
            $table->string('nama', 255);
            $table->string('noTelp', 15)->nullable();
            $table->string('password', 100);
            $table->string('userRole', 40);
        });
    }

    public function down()
    {
        Schema::dropIfExists('userprofile');
    }
}
