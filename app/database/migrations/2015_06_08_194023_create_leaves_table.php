<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLeavesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('leaves', function(Blueprint $table)
		{
			$table->increments('leaves_id');
			$table->integer('users_id');
			$table->string('subject');
			$table->integer('leave_types_id');
			$table->date('leave_date');
			$table->string('description',512);
			$table->enum('leave_status',['pending','approve','reject','final-approve','final-reject'])->default('pending');
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
		Schema::drop('leaves');
	}

}
