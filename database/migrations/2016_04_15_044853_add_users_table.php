<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('users', function ($table) {
           $table->string('stripe_id')->nullable();
           $table->string('card_brand')->nullable();
           $table->string('card_last_four')->nullable();
           $table->timestamp('trial_ends_at')->nullable();
            $table->integer('verified')->default(0);
           $table->string('email_token')->nullable();
            $table->string('email_token')->nullable();
});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
