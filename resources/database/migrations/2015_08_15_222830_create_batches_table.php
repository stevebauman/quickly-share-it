<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batches', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->boolean('locked');
            $table->string('session_id');
            $table->string('password')->nullable();
            $table->integer('lifetime');
            $table->string('uuid');
            $table->string('name', 40);
            $table->text('description')->nullable();

            $table->unique(['uuid']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('batches');
    }
}
