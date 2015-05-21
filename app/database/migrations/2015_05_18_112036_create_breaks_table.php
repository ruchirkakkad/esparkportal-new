<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBreaksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('breaks', function(Blueprint $table)
		{
			$table->increments('breaks_id');
			$table->integer('staffings_id');
            $table->dateTime('break_in');
            $table->dateTime('break_out');
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
		Schema::drop('breaks');
	}

}
