<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user__profiles', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD:database/migrations/2020_09_24_100830_create_user_media_table.php
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('file');
=======
            $table->string('profile__picture')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
>>>>>>> a7bb5b7d277852773c04dda01742fe1be0425f06:database/migrations/2020_09_22_203525_create_user__profiles_table.php
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
        Schema::dropIfExists('user__profiles');
    }
}
