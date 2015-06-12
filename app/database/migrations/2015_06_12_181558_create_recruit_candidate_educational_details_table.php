<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRecruitCandidateEducationalDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('recruit_candidate_educational_details', function(Blueprint $table)
		{
			$table->increments('recruit_candidate_educational_details_id');
			$table->integer('recruit_candidate_id');
			$table->integer('educational_qualifications_id');
			$table->string('university');
			$table->string('passing_year', 50);
			$table->string('grade', 50);
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
		Schema::drop('recruit_candidate_educational_details');
	}

}
