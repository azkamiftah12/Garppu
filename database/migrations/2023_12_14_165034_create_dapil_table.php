<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDapilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dapil', function (Blueprint $table) {
            $table->id();
            $table->string('nama_dapil');
            $table->unsignedBigInteger('batch_id'); // Foreign key column

            // Define foreign key relationship
            $table->foreign('batch_id')->references('id')->on('batches'); // Delete related records if batch is deleted

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dapil');
    }
}
