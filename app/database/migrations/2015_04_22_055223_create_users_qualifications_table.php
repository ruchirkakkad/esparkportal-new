<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersQualificationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_qualifications', function (Blueprint $table) {
            $table->increments('users_qualifications_id');

            $table->unsignedInteger('user_id');
            $table->foreign('user_id')
                ->references('user_id')->on('users')
                ->onDelete('cascade');

            $table->string('education_detail');
            $table->string('education_university');
            $table->string('passing_year');
            $table->string('grade');

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
        Schema::drop('users_qualifications');
    }

}
