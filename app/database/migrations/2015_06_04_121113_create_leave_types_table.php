<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLeaveTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('leave_types', function(Blueprint $table)
		{
			$table->increments('leave_types_id');
			$table->string('leave_name');
			$table->string('leave_title');
			$table->string('leave_comment');
			$table->integer('start_duration');
			$table->integer('total_leaves');
			$table->string('total_leaves_type');
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
		Schema::drop('leave_types');
	}

}
