<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUserprofileTable extends Migration
{
    public function up()
    {
        Schema::table('userprofile', function (Blueprint $table) {
            $table->string('kelurahan', 255)->nullable();
            $table->string('rt', 10)->nullable();
            $table->string('rw', 10)->nullable();
            $table->string('no_tps', 10)->nullable();
            $table->string('rekening_bank', 255)->nullable();
            $table->string('no_rekening', 50)->nullable();
            $table->unsignedBigInteger('id_dapil')->nullable();

            // Define foreign key relationship
            $table->foreign('id_dapil')
                ->references('id')
                ->on('dapil'); // Adjust the deletion strategy as needed
        });
    }

    public function down()
    {
        Schema::table('userprofile', function (Blueprint $table) {
            $table->dropColumn('kelurahan');
            $table->dropColumn('rt');
            $table->dropColumn('rw');
            $table->dropColumn('no_tps');
            $table->dropColumn('rekening_bank');
            $table->dropColumn('no_rekening');
            $table->dropForeign(['id_dapil']);
            $table->dropColumn('id_dapil');
        });
    }
}
