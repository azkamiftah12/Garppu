<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdToSubRelawansTable extends Migration
{
    public function up()
    {
        Schema::table('sub_relawans', function (Blueprint $table) {
            $table->id();
        });
    }

    public function down()
    {
        Schema::table('sub_relawans', function (Blueprint $table) {
            $table->dropColumn('id');
        });
    }
}
