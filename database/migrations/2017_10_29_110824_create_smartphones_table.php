<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmartphonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smartphones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->references('id')->on('categories');
            $table->string('name');
            $table->string('cpu');
            $table->integer('ram')->unsigned();
            $table->integer('capacity')->unsigned();
            $table->string('manufacture');
            $table->integer('battery')->unsigned();
            $table->binary('sd_card');
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
        Schema::dropIfExists('smartphones');
    }
}
