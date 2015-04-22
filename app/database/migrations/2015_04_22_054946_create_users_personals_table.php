<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersPersonalsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_personals', function (Blueprint $table) {
            $table->increments('user_personal_id');

            $table->unsignedInteger('user_id');
            $table->foreign('user_id')
                ->references('user_id')->on('users')
                ->onDelete('cascade');

            $table->date('dob');
            $table->string('blood_group');
            $table->string('marital_status');
            $table->string('spouse_name');
            $table->date('aniversary_date');
            $table->string('driving_licence_no');
            $table->string('passport_no');
            $table->string('skills', 1000);
            $table->string('languages', 1000);
            $table->text('bio');
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
        Schema::drop('users_personals');
    }

}
