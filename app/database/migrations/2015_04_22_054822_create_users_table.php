<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('user_id');
            $table->string('first_name');
            $table->string('middle_name');
			$table->string('last_name');
			$table->string('email');
			$table->string('personal_email');
			$table->string('password');
			$table->string('profile_image');
			$table->string('gender');
			$table->date('doj');
			$table->string('employee_id');
			$table->integer('department_id');
			$table->integer('designation_id');
			$table->string('job_profile');
			$table->integer('role_id');
			$table->tinyInteger('user_status');
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
		Schema::drop('users');
	}

}
