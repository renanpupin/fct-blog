<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100);
            $table->string('slug');
//            $table->string('content', 100000);
            $table->text('content');
            $table->string('feature_img');
            $table->integer('id_category')->unsigned();
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_category')->references('id')->on('category');
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
        Schema::table('post', function(Blueprint $table) {
            $table->dropForeign(['id_user']);
            $table->dropForeign(['id_category']);
        });

        Schema::drop('post');
    }
}
