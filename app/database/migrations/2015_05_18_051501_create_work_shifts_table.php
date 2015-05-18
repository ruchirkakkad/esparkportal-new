<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWorkShiftsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('work_shifts', function(Blueprint $table)
		{
			$table->increments('work_shifts_id');
			$table->string('work_shifts_name');
			$table->string('staffing');
			$table->time('office_start_time');
			$table->time('office_end_time');

            $table->time('break_start_time');
			$table->time('break_end_time');

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
		Schema::drop('work_shifts');
	}

}
