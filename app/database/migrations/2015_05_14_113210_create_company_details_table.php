<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompanyDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('company_details', function(Blueprint $table)
		{
			$table->increments('company_details_id');
			$table->string('company_name');
			$table->string('company_url');
			$table->string('company_address');
			$table->string('company_phone');
			$table->string('cp_first_name');
			$table->string('cp_last_name');
			$table->string('cp_email');
			$table->string('cp_phone');
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
		Schema::drop('company_details');
	}

}
