<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdditionalRequirementsLogosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('additional_requirements_logos', function (Blueprint $table) {
            $table->increments('id');

            $table->longText('data');

            $table->integer('additional_requirements_id')->unsigned()->nullable();
            $table->foreign('additional_requirements_id')->references('id')->on('additional_requirements_logo_prices')->onDelete('set null');

            $table->integer('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

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
        Schema::drop('additional_requirements_logos');
    }
}
