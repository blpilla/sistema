<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateElementCondominiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('element_condominia', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('element_id')->unsigned();
            $table->integer('condominium_id')->unsigned();
            $table->unique(['element_id', 'condominium_id']);
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('element_condominia');
    }
}
