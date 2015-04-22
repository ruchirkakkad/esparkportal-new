<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersContactsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_contacts', function (Blueprint $table) {
            $table->increments('contact_id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')
                ->references('user_id')->on('users')
                ->onDelete('cascade');

            $table->string('current_address');
            $table->string('current_city');
            $table->string('current_state');
            $table->integer('current_zipcode');
            $table->string('current_phone');
            $table->string('current_skype');
            $table->string('permanent_address');
            $table->string('permanent_city');
            $table->string('permanent_state');
            $table->integer('permanent_zipcode');
            $table->string('permanent_phone');
            $table->string('permanent_skype');
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
        Schema::drop('users_contacts');
    }

}
