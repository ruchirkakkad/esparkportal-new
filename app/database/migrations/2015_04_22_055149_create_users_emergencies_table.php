<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersEmergenciesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_emergencies', function (Blueprint $table) {
            $table->increments('users_emergencies_id');

            $table->unsignedInteger('user_id');
            $table->foreign('user_id')
                ->references('user_id')->on('users')
                ->onDelete('cascade');

            $table->string('contact_name');
            $table->string('contact_relation');
            $table->string('contact_phone');
            $table->string('contact_address',1000);

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
        Schema::drop('users_emergencies');
    }

}
