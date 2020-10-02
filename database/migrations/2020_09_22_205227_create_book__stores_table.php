<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateBookStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book__stores', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD:database/migrations/2020_09_24_100143_create_book__stores_table.php
            $table->string('author');
            $table->string('title');
            $table->string('price');
            $table->string('category');
=======
>>>>>>> a7bb5b7d277852773c04dda01742fe1be0425f06:database/migrations/2020_09_22_205227_create_book__stores_table.php
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
        Schema::dropIfExists('book__stores');
    }
}
