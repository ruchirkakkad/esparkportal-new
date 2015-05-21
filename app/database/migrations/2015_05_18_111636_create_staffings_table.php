<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStaffingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('staffings', function(Blueprint $table)
		{
			$table->increments('staffings_id');
			$table->integer('users_id');
			$table->dateTime('check_in');
			$table->dateTime('check_out');
			$table->string('comment');
			$table->string('flag');
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
		Schema::drop('staffings');
	}

}
