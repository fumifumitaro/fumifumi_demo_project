<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserLikes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_likes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('like')->default('false');

            $table->bigInteger('user_id')->unsigned()->index();
            $table->bigInteger('article_id')->unsigned()->index();
            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade');
            $table->foreign('article_id')->on('articles')->references('id')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_likes');
    }
}
