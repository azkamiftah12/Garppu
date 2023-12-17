<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartaisTable extends Migration
{
    public function up()
    {
        Schema::create('partais', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->string('nama_partai');
            $table->timestamps(); // Created_at dan updated_at

            // Foreign key to candidates table
            $table->unsignedBigInteger('candidate_id')->nullable();
            $table->foreign('candidate_id')->references('id')->on('candidates');
        });
    }

    public function down()
    {
        Schema::dropIfExists('partais');
    }
}
