<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTractorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tractor', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('model');
            $table->integer('model_number');
            $table->text('description');
            $table->integer('year_of_manufacture');
            $table->integer('hours');
            $table->integer('condition');
            $table->integer('category');
            $table->integer('horsepower');
            $table->integer('drive');
            $table->string('picture');
            $table->decimal('amount', 15, 5);
            $table->timestamps();

            $table->foreign('category')->references('id')->on('tractor_category');
            $table->foreign('model')->references('id')->on('tractor_model');
            $table->foreign('drive')->references('id')->on('drive');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tractor');
    }
}
