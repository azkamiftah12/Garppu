<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveProvinsiFromDapil extends Migration
{
    public function up()
    {
        Schema::table('dapil', function (Blueprint $table) {
            $table->dropColumn('provinsi');
        });
    }

    public function down()
    {
        Schema::table('dapil', function (Blueprint $table) {
            $table->string('provinsi');
        });
    }
}
