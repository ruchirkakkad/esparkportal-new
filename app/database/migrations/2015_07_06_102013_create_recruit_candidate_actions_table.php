<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRecruitCandidateActionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('recruit_candidate_actions', function(Blueprint $table)
		{
			$table->increments('recruit_candidate_actions_id');
			$table->integer('recruit_candidate_id');
            $table->date('date');
            $table->time('time');
            $table->string('action');
            $table->string('subject');
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
		Schema::drop('recruit_candidate_actions');
	}

}
