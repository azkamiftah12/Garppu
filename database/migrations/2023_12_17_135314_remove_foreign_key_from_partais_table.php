<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveForeignKeyFromPartaisTable extends Migration
{
    public function up()
    {
        // Hapus foreign key dari tabel partais
        Schema::table('partais', function (Blueprint $table) {
            $table->dropForeign(['candidate_id']);
            $table->dropColumn('candidate_id');
        });
    }

    public function down()
    {
        // Tambahkan kembali foreign key ke tabel partais
        Schema::table('partais', function (Blueprint $table) {
            $table->unsignedBigInteger('candidate_id')->nullable();
            $table->foreign('candidate_id')->references('id')->on('candidates');
        });
    }
}
