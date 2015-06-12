<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRecruitCandidatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('recruit_candidates', function(Blueprint $table)
		{
			$table->increments('recruit_candidates_id');
			$table->string('recruit_candidates_fname', 100);
			$table->string('recruit_candidates_mname', 100);
			$table->string('recruit_candidates_lname', 100);
			$table->text('recruit_candidates_address');
			$table->string('recruit_candidates_email');
			$table->string('recruit_candidates_contact_no', 100);
			$table->integer('recruit_candidates_apply_for');
			$table->text('recruit_candidates_skills');
			$table->string('recruit_candidates_category', 100);
			$table->string('recruit_candidates_resume');

			$table->enum('recruit_candidates_status', array('Pending', 'Selected', 'Rejected'))->default('Pending');
			$table->enum('recruit_candidates_action', array('To Be Scheduled', 'Reschedule', 'Offer Letter', 'Rejected', 'Selected'))->default('To Be Scheduled');
			$table->smallInteger('recruit_candidates_schedule_count');
			$table->dateTime('recruit_candidates_selected_date');
			$table->dateTime('recruit_candidates_rejected_date');
			$table->dateTime('recruit_candidates_reject_note');

			$table->timestamps();

			$table->string('schedule_from_email');
			$table->string('schedule_to_email');
			$table->date('schedule_date');
			$table->time('schedule_time');
			$table->string('schedule_subject');
			$table->text('schedule_message');
			$table->string('schedule_candidate_name');
			$table->string('schedule_applied_for');
			$table->text('schedule_interview_venue');
			$table->string('schedule_hr_name');
			$table->string('schedule_hr_contact');
			$table->string('schedule_hr_email');
			$table->string('schedule_company_website');

			$table->string('ofrltr_from_email');
			$table->string('ofrltr_to_email');
			$table->dateTime('ofrltr_date');
			$table->string('ofrltr_subject');
			$table->text('ofrltr_message');
			$table->date('ofrltr_joining_date');
			$table->time('ofrltr_joining_time');
			$table->string('ofrltr_ctc');
			$table->string('ofrltr_candidate_name');
			$table->string('ofrltr_department');
			$table->string('ofrltr_post');
			$table->string('ofrltr_number', 100);
			$table->text('ofrltr_venue');
			$table->string('ofrltr_hr_name');
			$table->string('ofrltr_hr_contact');
			$table->string('ofrltr_hr_email');
			$table->string('ofrltr_company_website');

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
		Schema::drop('recruit_candidates');
	}

}
