<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTelevisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('televisions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->references('id')->on('categories');
            $table->string('name');
            $table->integer('frequency')->unsigned();
            $table->string('cpu');
            $table->string('manufacture');
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
        Schema::dropIfExists('televisions');
    }
}
