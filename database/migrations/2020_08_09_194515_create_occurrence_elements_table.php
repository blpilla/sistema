<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOccurrenceElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('occurrence_elements', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('element_id')->unsigned();
            $table->integer('occurrence_id')->unsigned();
            $table->unique(['element_id', 'occurrence_id']);
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('occurrence_elements');
    }
}
