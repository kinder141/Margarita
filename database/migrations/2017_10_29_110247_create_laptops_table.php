<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaptopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laptops', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->references('id')->on('categories');
            $table->string('name');
            $table->string('cpu');
            $table->integer('ram')->unsigned();
            $table->string('video_card');
            $table->binary('video');
            $table->integer('capacity')->unsigned();
            $table->string('manufacture');
            $table->integer('battery')->unsigned();
            $table->decimal('display', 10, 2);
            $table->decimal('price', 10, 2);
            $table->integer('amount')->unsigined();
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
        Schema::dropIfExists('laptops');
    }
}
