<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMarketingDatasNotesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('marketing_datas_notes', function(Blueprint $table)
		{
			$table->increments('marketing_datas_notes_id');
            $table->integer('marketing_datas_id');
            $table->string('message',1000);
            $table->date('note_date');
            $table->time('note_time');
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
		Schema::drop('marketing_datas_notes');
	}

}
