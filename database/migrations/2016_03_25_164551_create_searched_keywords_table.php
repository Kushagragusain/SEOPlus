<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSearchedKeywordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('searched_keywords', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('url_id');
            $table->string('url');
            $table->string('keyword');
            $table->string('searched_at');
            $table->string('status');
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
        Schema::drop('searched_keywords');
    }
}
